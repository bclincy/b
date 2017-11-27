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
        $this->view = $container->get('view');
    }


    public function test() {
        // your code here
        // use $this->view to render the HTML
        return 'sike';
    }

    public function indexAction (Request $request, Response $response)
    {
        return $this->view->render($response, 'contact.html.twig', ['title' => 'Home again']);
    }

    public function category (Request $request, Response $response, $args)
    {
        $pdo = $this->container->get('pdo');
        if ($args['category'] === 'about') {
            return $this->aboutIndex($request, $response, $args);
        }
        die(print_r($request->getAttribute('category'), true));
        return $this->view->render($response, 'index.html.twig', ['title' => 'Home again']);
    }
    public function aboutIndex (Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'goals.html.twig', ['title' => 'My Goals']);
    }
}