<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/12/18
 * Time: 5:01 PM
 * @package Crawler
 * @author Brian Clincy <https://github.com/bclincy>
 * @author  Josh Lockhart <https://github.com/codeguy>
 * @author  Zeid Rashwani <http://zrashwani.com>
 */

namespace App\Content;

use GuzzleHttp\Client as client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class UserLookup
 * @package App\Content
 * Simular to what the fbcrawler is doing, we're going to use this class to scrape user information from off the web
 */
class UserLookup
{


    /**
     * The base URL from which the crawler begins crawling
     * @var string
     */
    protected $baseUrls = [
      'whitepages' => 'https://www.whitepages.com/name/',
      'peoplebyname' => 'http://www.peoplebyname.com/people/',
      'more' => 'https://www.whitepages.com/name/Cecilia-Castaneda/49442?q=Cecilia%20Castaneda&l=49442'

    ];

    protected $name = ['whitepages' => 'fname-lname', 'peoplebyname' => 'lname/fname'];

    /**
     * Array of links (and related data) found by the crawler
     * @var array
     */
    protected $links;

    /** @var client $client */
    protected $client;

    /**
     * UserLookup constructor.
     */
    public function __construct()
    {
        $this->client = new client([
          'headers' => ['user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'],
          'timeout' => 60,
          'verify' => false,
        ]);
    }


    public function searchNames(string $fname, string $lname)
    {
        $lookup = $this->client->request('GET', 'http://www.peoplebyname.com/people/Castaneda/Cecilia/Muskegon/MI');
        if ($lookup->getStatusCode() === 200 ){
            $new = $lookup->getBody()->getContents();
            echo $new;
            $crawler = new Crawler($new);
            $hope = $crawler->filter('#hdr_middle > div > ul')->children();

            foreach($hope as $value)
            {
                var_dump($value->childNodes->item(3)->nodeValue);
            }
//            echo var_dump($hope->each('node'));
            $i = 0;
        }
//        foreach ($this->baseUrls as $url) {
//
//        }
    }


    /**
     * create and configure goutte client used for scraping
     * @return GoutteClient
     */
    protected function getScrapClient()
    {
        $client = new GoutteClient();
        $client->followRedirects();

        $guzzleClient = new \GuzzleHttp\Client(array(
            'curl' => array(
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
            ),
        ));
        $client->setClient($guzzleClient);

        return $client;
    }

    /**
     * extrating the relative path from url string
     * @param  type $url
     * @return string $url
     */
    protected function getPathFromUrl($url)
    {
        if (strpos($url, $this->baseUrl) === 0 && $url !== $this->baseUrl) {
            return str_replace($this->baseUrl, '', $url);
        } else {
            return $url;
        }
    }

    /**
     * Display output on a page
     * @return html
     */
    public function displaySample ()
    {
        if (count($this->links) < 1) {
            return 'No Links';
        }

        $str = ' https://radaris.com/p/Brian/Clincy/
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Facebook Posts</title>
                <!-- css -->
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                </head>
                <body>
                <div class="container-fluid">
                <div id="fb-root"></div>
                    <script>
                        (function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id))
                                return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, \'script\', \'facebook-jssdk\'));
                    </script>
                    <div class="row">
            <div class="fb-post" data-href="https://www.facebook.com/lovecommunitygarden/posts/1174744925878700"></div></div>';
                    foreach ($this->links as $value) {
                        $str.= '<div class="row"> <div class="fb-post" data-href="'. $value . '"></div></div>'."\n";
                    }
                    $str .='</div></body></html>';
        return $str;
    }

}