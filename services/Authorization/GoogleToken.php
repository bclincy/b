<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/18/18
 * Time: 12:15 AM
 */

namespace App\Authorization;

use Google\Auth\ApplicationDefaultCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class GoogleToken
{

    public function init()
    {

        // specify the path to your application credentials
        putenv(__DIR__ . '/googleaipcoauthcreds.json');

        // define the scopes for your API call
        $scopes = ['https://www.googleapis.com/auth/drive.readonly'];

        // create middleware
        $middleware = ApplicationDefaultCredentials::getMiddleware($scopes);
        $stack = HandlerStack::create();
        $stack->push($middleware);

        // create the HTTP client
        $client = new Client([
            'handler' => $stack,
            'base_uri' => 'https://www.googleapis.com',
            'auth' => 'google_auth'  // authorize all requests
        ]);

        // make the request
        $response = $client->get('drive/v2/files');

        // show the result!
        print_r((string) $response->getBody());

    }

}