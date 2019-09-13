<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/3/18
 * Time: 7:58 AM
 */

namespace App\Content;

use Doctrine\ORM\EntityManager;
use App\Entity\Podcast as Podcasts;


/**
 * Class Podcast
 * @package app\Content
 */
class Podcast extends Model
{
    /**
     * @var EntityManager $pdo
     */
    private $em;
    /**
     * @var int $pid
     */
    private $pid;
    /**
     * @var array $notesId
     */
    private $notesId;

    private $page;

    /**
     * Podcast constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function totalPodcast()
    {
        $stmt = $this->em->getConnection()->prepare('SELECT count(id) FROM podcast');
        $stmt->execute();
        $result = $stmt->fetchColumn(0);

        return $result;
    }

    public function getByName(string $name): array
    {
        $name = '%' . $name . '%';
        $query = $this->em->prepare('SELECT * FROM podcast where title like :name');
        $query->execute([':name' => $name]);
        $results = $query->fetchAll();

        return $results[0];
    }

    public function displayPodcast()
    {
        $stmt = $this->em->getConnection()->prepare('SELECT * FROM podcast ORDER BY id DESC');
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * @param array $podcasts
     * @return \SimpleXMLElement
     */
    public function rssFeed(array $podcasts): \SimpleXMLElement
    {
        $xml = new \SimpleXMLElement('<rss/>');
        $xml->addAttribute('version', '2.0');
        $xml->addAttribute('xmlns:content', 'http://purl.org/rss/1.0/modules/content/');
        $channel = $xml->addChild('channel');
        $this->createChannel($channel);
        foreach ($podcasts as $podcast) {
            $item = $channel->addChild('item');
            array_walk_recursive($podcast->toArray(), [$this, 'addItems'], $item);
        }

        return $xml;

    }

    /**
     * @param string|\DateTime $value
     * @param string $key
     * @param \SimpleXMLElement $xml
     */
    private function addItems($value, string $key, \SimpleXMLElement &$xml): void
    {
        if ($value instanceof \DateTime) {
            $value = $value->format(DATE_ATOM);
        } elseif (is_array($value)) {
            $item = $xml->addChild($key);
            array_walk($value, [$this, 'addItems'], $item);
        }
        if (strpos($key, ':') > 0) {
            list($ns, $name) = explode(':', $key);
            $xml->addChild($ns . ':' . $name, $value, $ns);
        } else {
            $xml->addChild($key, $value);
        }
    }

    /**
     * @param \SimpleXMLElement $xml
     * @return \SimpleXMLElement
     */
    private function createChannel(\SimpleXMLElement &$xml): \SimpleXMLElement
    {
        // RSS channel properties
        $channel = [
          'title' => 'Nothing New Under the Sun Podcast NNUTS',
          'link' => 'http://brianclincy.com/nnuts',
          'description' => 'Nothing New Under the Sun aka NNUtSun is a tribute to the past and describing the present with lessons from the past',
          'language' => 'en-us',
          'webmaster' => 'brian@brianclincy.com (Brian Clincy)',
          'copyright' => '&#xA9;2016',
          'keywords' => 'Culture, technology, Black People, old-school, new-school, hip-hop, news',
          'image_title' => 'NNUtS',
          'image_link' => 'http://brianclincy.com/nnuts',
          'image_url' => 'http://brianclincy.com/nnut-rss.jpg',
          'image_height' => 200,
          'image_width' => 200,
          'image' => [
            'url' => 'http://brianclincy.com/nnut-rss.jpg',
            'title' => 'Brian Clincy Present Nothing New Under the Sun (NNUtS) the podcast',
            'link' => 'http://brianclincy.com/nnuts'
          ],
            'itunes:owner' => [
            'itunes:name' => 'Brian Clincy',
            'itunes:email' => 'nnuts@briancllincy.com',
          ],
          'itunes:keywords' => 'Culture, technology, Black People, old-school, new-school, hip-hop, news',
          'itunes:explicit' => 'yes',
          'itunes:summary' => 'Brian Clincy Presents Nothing New Under the Sun the Podcast all about the culture of my elders being passed down to me to pass along to future generations.',
          'itunes:description' => 'Brian Clincy Presents Nothing New Under the Sun the Podcast all about the culture of my elders being passed down to me to pass along to future generations.',
          'explicit' => 'yes',
          'category' => 'Society & Culture',
          'itunes:isClosedCaptioned' => 'No',
          'itunes:author' => 'Brian Clincy Nothing New Under the Sun',
        ];
        array_walk($channel, [$this, 'addItems'], $xml);
        $itunesns = 'http://www.itunes.com/dtds/podcast-1.0.dtd';
        $cat = $xml->addChild('category', '', $itunesns);
        $cat->addAttribute('text','Society & Culture');
        $subCat = $cat->addChild('category', '', $itunesns);
        $subCat->addAttribute('text', 'Technology');
        $atom = $xml->addChild('atom', '', 'link');
        $atom->addAttribute('rel', 'self');
        $atom->addAttribute('type', 'application/rss+xml');

        return $xml;
    }

}