<?php

namespace app\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController
{
    public function indexAction (Request $request, Response $response)
    {
        return 'Home Controllers';
    }
}