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
        }
        $xml->addChild($key, $value);
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
          'image_title' => 'NNUtS',
          'image_link' => 'http://brianclincy.com/nnuts',
          'image_url' => 'http://brianclincy.com/nnut-rss.png',
        ];
        array_walk($channel, [$this, 'addItems'], $xml);

        return $xml;
    }
}