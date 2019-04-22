<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/1/18
 * Time: 7:12 PM
 */

namespace App\Content;

use App\Authorization\Encryptor;
use GuzzleHttp\Client as client;

class youtubeListing
{

    /**
     * @var string $channel
     */
    private $channel;
    /**
     * @var string $client
     */
    private $client;
    /**
     * @var string $key
     */
    private $key;
    /**
     * @var array $listing
     */
    private $listing;

    /**
     * youtubeListing constructor.
     * @param $channel
     * @param $client
     * @param $key
     */
    public function __construct($channel, client $client, $key)
    {
        $this->channel = $channel;
        $this->client = $client;
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function init()
    {
        $this->uploadPlaylist();
        if($this->listing !== null) {
            return $this->listing;
        }
        return [];
    }

    /**
     * @return bool
     */
    private function uploadPlaylist ()
    {
        $url = 'https://www.googleapis.com/youtube/v3/channels';
        $res = $this->client->request('GET', $url, [
            'query' => [
                'part' => 'contentDetails',
                'forUsername' => $this->channel,
                'key' => $this->key,
            ]
        ]);

        $data = json_decode($res->getBody());
        $playlistId = $data->items[0]->contentDetails->relatedPlaylists->uploads;
//        $playlistId = $data->items[0]->contentDetails->relatedPlaylists->favorites;

        if ($playlistId !== null) {
            $this->getPlaylistData($playlistId, 30);

            return true;
        }

        return false;

    }

    /**
     * @param $playId
     * @param int $maxResults
     * @return bool
     */
    private function getPlaylistData($playId, $maxResults = 20)
    {
        $url = 'https://www.googleapis.com/youtube/v3/playlistItems';
        $res = $this->client->request('GET', $url, [
            'query' => [
                'part' =>'snippet,contentDetails',
                'maxResults' => $maxResults,
                'key' => $this->key,
                'playlistId'=> $playId,
            ]
        ]);

        $data = json_decode($res->getBody());
        if ($data->items !== null) {
            $details['channelTitle'] = $data->items[0]->snippet->channelTitle;
            foreach ($data->items as $item) {
                $details[] = [
                    'title' => $item->snippet->title,
                    'id' => $item->contentDetails->videoId,
                    'description' => $item->snippet->description,
                    'thumbnail' => [
                        'url' => $item->snippet->thumbnails->high->url,
                        'width' => $item->snippet->thumbnails->high->width,
                        'height' => $item->snippet->thumbnails->high->height,
                    ],
                    'uploadOn' => $item->snippet->publishedAt,
                    'url' => 'https://youtube.com/embed/'. $item->contentDetails->videoId,
                ];
            }
            $details['hash'] = $this->generateHash();
            $this->listing = $details;

            return true;
        }

        return false;
    }

    public function getNNutsPodcast($maxResults = 50)
    {
        $playId = 'PLbr65wHASbIfbTY-sMmUvWEIyojfXzkHm';
        $url = 'https://www.googleapis.com/youtube/v3/playlistItems';
        $res = $this->client->request('GET', $url, [
          'query' => [
            'part' =>'snippet,contentDetails',
            'maxResults' => $maxResults,
            'key' => $this->key,
            'playlistId'=> $playId,
          ]
        ]);

        $data = json_decode($res->getBody());
        $details = [];
        if ($data->items !== null) {
            $details['channelTitle'] = $data->items[0]->snippet->channelTitle;
            foreach ($data->items as $item) {
                $details[] = [
                  'title' => $item->snippet->title,
                  'id' => $item->contentDetails->videoId,
                  'description' => $item->snippet->description,
                  'thumbnail' => [
                    'url' => $item->snippet->thumbnails->high->url,
                    'width' => $item->snippet->thumbnails->high->width,
                    'height' => $item->snippet->thumbnails->high->height,
                  ],
                  'uploadOn' => $item->snippet->publishedAt,
                  'url' => 'https://youtube.com/embed/' . $item->contentDetails->videoId,
                ];
            }
        }

        return $details;
    }

    private function createGenesisBlock()
    {
        if (!isset($this->listing['hash'])) {
            $this->listing['meta'] = [
                'name' => 'Youtube BlockChain',
                'author' => 'Brian Clincy',
                'version' => '1.0.0',
                'hash' => 'Genesis',
            ];
        }
    }

    private function isChainValid()
    {
        
    }

    private function addBlock()
    {

    }

    private function generateHash()
    {
        return encryptor::encryptStr(serialize($this->listing));
    }

    public function getDetails(): array
    {
        return $this->listing;
    }
}