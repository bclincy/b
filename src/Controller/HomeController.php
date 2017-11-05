<?php

namespace app\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as view;
class HomeController
{
    protected $view;

    public function __construct() {
        $this->view = new view('resources/views', ['cache' => false]);
    }
    public function home(Request $request, Response $response, $args) {
        // your code here
        // use $this->view to render the HTML
        return $response;
    }
}