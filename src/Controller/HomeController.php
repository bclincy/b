<?php

namespace app\Controller;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as view;
class HomeController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function test() {
        // your code here
        // use $this->view to render the HTML
        return 'sike';
    }

    public function indexAction ()
    {
        return $this->view->render($this->response, 'index.html.twig', ['title' => 'Home again']);
    }

    public function category (Request $request, $response, $args)
    {

        die(print_r($request->getAttribute('category'), true));
        return $this->view->render($response, 'index.html.twig', ['title' => 'Home again']);
    }
}