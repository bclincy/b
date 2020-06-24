<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/12/18
 * Time: 11:40 AM
 */

namespace App\Content;
use App\Content\imageProcess as Img;

class Display extends Model
{
    protected $media;
    protected $default = [
      'image' => 'images/opendefault.jpg',
      'description' => 'Brian Clincy in the making is putting together all his understanding, experience and wisdom 
      into making a man. '];

    public function newResume()
    {
        
    }

    /**
     * @param $title string
     * @return mixed
     */
    public function searchDocs (string $title)
    {
        $title = str_ireplace('_', ' ', $title);
        $bqtitle = '%'.$title.'%';
        $sql = 'SELECT * 
                FROM docs d
                LEFT JOIN media m ON d.id = m.docId 
                WHERE title like :title AND active = 1';
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':title', $bqtitle);
        $q->execute();
        $results = $q->fetchAll();

        return $this->formatContent($results);
    }

    public function findPost(string $title): ?array
    {
        
    }
    /**
     * @param $cat
     * @return mixed
     */
    public function searchCats (string $cat)
    {
        $cat = str_ireplace('_', ' ', $cat);
        $bqCat = '%'.$cat.'%';
        $sql = 'SELECT * 
                FROM docs d
                LEFT JOIN media m ON d.id = m.docId  
                WHERE category like :cat AND active = 1';
        $q = $this->pdo->prepare($sql);
        $q->bindParam(':cat', $bqCat);
        $q->execute();
        $results = $q->fetchAll();

        return $results;
    }

    public function formatContent (array $data)
    {
        if (!empty($data) && count($data) > 1) {
            $medkeys = ['relpath', 'filepath', 'savefile', 'createdOn', 'ogType', 'displayOg'];
            foreach ($data as $key => $row) {
                foreach ($medkeys as $index => $medkey) {
                    $this->media[$key][$medkey] = $row[$medkey];
                }
                $data[$key] = array_diff_key($data[$key], array_flip($medkeys));
            }
            $data = $data[0];
            try {
                $data['media'] = $this->media;
                $data['meta'] = $this->openData($data);
            } catch (\Exception $e) {
                $this->container->logger->error('Open Graph media is not available and errored');
                $data = [];
            }
        }

        return $data;
    }

    /**
     * @param null $img
     * @return string
     */
    public function openGraphImage ($img = null)
    {
        if (!is_array($img)) {
            $path = '/images/images/handed.jpg';
            $type = 'image';
        } else {
            $img = $img ?? $this->media;
            $key = array_search(true, array_column($img, 'displayOg'));
            $path = $key === false ? $img[0]['relpath'] : $img[$key]['relpath'];
            $type = $key === false ? $img[0]['ogType'] : !isset($img[$key]['ogType']) ? 'image' : $img[$key]['ogType'];
        }

        return '<meta property="og:'. $type . '" content="'. $this->container['baseUrl'] . $path .'" />';
    }

    public function authorize (string $str)
    {
        $sumOfNumbs = $this->sum_num_in_str($str);
        if (is_array($_SESSION['viewResume'])) {
            $data = json_decode(base64_decode($str), true);
            $create = (new \DateTime())->setTimestamp($_SESSION["viewResume"][1]);
            $now = new \DateTime();
            $diff = $create->diff($now);
            $return = ($diff->format('%h') < 2 && $diff->format('%d') < 1)
              && filter_var($_SESSION["viewResume"][0]["email"], FILTER_VALIDATE_EMAIL);
            if ($diff->format('%h') > 3) { unset($_SESSION['viewResume']);}

        } elseif (in_array($sumOfNumbs, [75, 305, 22])) {
            $return = true;
        } else { $return = false; }

        return $return;
    }


    public function galleryOptions (string $gal = null, $root, $rewrite)
    {
        $galleries = [
          'clincy' => '/images/gallery/clincy',
          'gallery' => '/images/gallery/',
          'images' => '/images/',
        ];
        $gallery = in_array($gal, $galleries) ? $galleries[$gal] : '/images/gallery/';
        $images = new Img($root, $gallery, true );
        if ($rewrite === $_ENV['rewrite_key'] ) {
            $images->maxWebImg($images->images[0]['images']);
        }

        return $images->images;

    }

    /**
     * @param $title
     * @return string
     */
    private function createCanonicalUrl (string $title)
    {
        //This is direct contact link
        // Todo: Add a catch for title with query strings
        $title = stristr($title, ' ') ? $title : str_ireplace(' ', '_', $title);

        return '/'.$title;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function openData (array $data)
    {
        $data['title'] = isset($data['title']) ? $data['title'] : $_SERVER['PHP_SELF'];
        $type = $data['docType'] === 'Video' ? 'video.movie' : $data['docType'] === 'Podcast' ? 'podcast' : 'website';
        $meta['oURL'] = '<meta property="og:url" content="' . $this->container['baseUrl']
          . $this->createCanonicalUrl($data['title']) . '" />';
        $meta['oTitle'] = '<meta property="og:title" content="' . $data['title'] . '" />';
        $meta['oType'] = '<meta property="og:type" content="' . $type . '" />';
        $meta['image'] = $this->openGraphImage($data['media']);
        $meta['canconical'] = '<link rel="canonical" href="' .$this->container['baseUrl']
          . $this->createCanonicalUrl($data['title']) . '" />"';

        return $meta;

    }

    private function sum_num_in_str (string $str)
    {
        $numbers = str_split(preg_replace('/\D/', '', $str));
        $num2arr = array_map('intval', $numbers);

        return array_sum($num2arr);
    }

    private function nl2p(string $str)
    {
        return '<p>' . preg_replace(['/([\n|\r]+)/i'],
            ['</p>\n<p>', '</p>\n<p>', '$1 $2'],
            strip_tags(trim($str), '<div><li><ol>')) . '</p>';

    }

}