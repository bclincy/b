<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/12/18
 * Time: 11:40 AM
 */

namespace App\Content;


class Display extends Model
{

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
            $media = array_map(function ($row) {
                return [
               'relpath' => $row['relpath'],
               'filepath'=> $row['filepath'],
               'savefile'=> $row['savefile'],
               'modified'=> $row['modifiedOn']
                ];
            }, $data);
            $data = array_pop($data);
            $data['media'] = $media;
        }

        return $data;

    }


    /**
     * @param $title
     * @return string
     */
    private function createCanonicalUrl (string $title)
    {
        //This is direct contact link
        $title = stristr($title, '_') ? $title : str_ireplace(' ', '_', $title);

        return '/'.$title;
    }

    /**
     * @param $data
     */
    private function openData ($data)
    {
        $type = $data['docType'] === 'Video' ? 'video.movie' : $data['docType'] === 'Podcast' ;
        $meta['oURL'] = '<meta property="og:url" content="' . $this->createCanonicalUrl($data['title']) . '" />';
        $meta['oTitle'] = '<meta property="og:title" content="' . $data['title'] . '" />';
        $meta['oType'] = '<meta property="og:type" content="' . $type . '" />';
        $this->meta .= '<meta property="og:link" content="' . $url . '" />';
        $this->meta .= '<meta property="og:image" content="' . $this->openGraphImage() . '" />';

    }
}