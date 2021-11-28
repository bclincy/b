<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 2/2/18
 * Time: 6:09 PM
 */

namespace App\Content;

use GuzzleHttp\Psr7\Request as http;
use GuzzleHttp\Client as Client;

class LocationDetails
{
    private $client;
    private $http;

    /**
     * LocationDetails constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    public function getLocation ($location)
    {
        $client = new Client();
        $request = new http('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode($location));
        $promise = $client->sendAsync($request)->then(function ($response) {
            echo 'I completed! ' . $response->getBody();
        });
        $promise->wait();
    }
}