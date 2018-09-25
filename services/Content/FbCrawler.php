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


class FbCrawler
{
    /**
     * The base URL from which the crawler begins crawling
     * @var string
     */
    protected $baseUrl;


    /**
     * Array of links (and related data) found by the crawler
     * @var array
     */
    protected $links;

    protected $client;


    /**
     * FbCrawler constructor.
     * @param string $baseUrl
     * @param client $client
     */
    public function __construct($baseUrl = 'https://www.facebook.com/brianclincy', client $client)
    {
        $this->baseUrl = $baseUrl;
        $this->links = array();
        $this->client = $client;
    }

    /**
     * Get links (and related data) found by the crawler
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    public function fblinks()
    {
        try{
            $client = $this->getScrapClient();
            $crawler = $client->request('GET', $this->baseUrl);
            $statusCode = $client->getResponse()->getStatus();

            if ($statusCode === 200) {
                $content_type = $client->getResponse()->getHeader('Content-Type');

                if (strpos($content_type, 'text/html') !== false ) {
                    $crawler->filter('a')->each(
                        function ($node, $i) {
                            $node_url = $node->attr('href');
//                            echo '<pre>'.print_r($node, true) . '</pre>';
                            $this->linkInfo($node_url, $node->text());
                        }
                    );
                }

            }
            return true;

        } catch (CurlException $e) {
            $this->links[$url]['status_code'] = '404';
            $this->links[$url]['error_code'] = $e->getCode();
            $this->links[$url]['error_message'] = $e->getMessage();
        } catch (\Exception $e ) {
            $this->links[$url]['status_code'] = '404';
            $this->links[$url]['error_code'] = $e->getCode();
            $this->links[$url]['error_message'] = $e->getMessage();
        }
    }

    /**
     * Populate links
     * @param string link
     * @return bool
     */

    private function linkInfo ($link, $text)
    {
        if (preg_match('/^\/lovecommunitygarden\/posts\//', $link)) {
            $this->links[$link] = 'https://www.facebook.com' . $link;
            //Todo: Add dates or post type from the Text
            return true;
        } else {
            return false;
        }
    }

    /**
     * Is a given URL crawlable?
     * @param  string $uri
     * @return bool
     */
    protected function checkIfCrawlable($uri)
    {
        if (empty($uri) === true) {
            return false;
        }

        $stop_links = array(
            '@^javascript\:.*$@i',
            '@^#.*@',
            '@^mailto\:.*@i',
            '@^tel\:.*@i',
            '@^fax\:.*@i',
        );

        foreach ($stop_links as $ptrn) {
            if (preg_match($ptrn, $uri) == true) {
                return false;
            }
        }

        return true;
    }

    /**
     * Is URL external?
     * @param  string $url An absolute URL (with scheme)
     * @return bool
     */
    protected function checkIfExternal($url)
    {
        $base_url_trimmed = str_replace(array('http://', 'https://'), '', $this->baseUrl);

        return preg_match("@http(s)?\://$base_url_trimmed@", $url) == false;
    }

    /**
     * Normalize link (remove hash, etc.)
     * @param  string $uri
     * @return string
     */
    protected function normalizeLink($uri)
    {
        return preg_replace('@#.*$@', '', $uri);
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

        $str = '
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