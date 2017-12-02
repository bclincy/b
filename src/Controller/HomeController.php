<?php

namespace app\Controller;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as view;
class HomeController
{
    protected $container;
    protected $title;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $container->get('view');
        $this->pdo = $this->container->get('pdo');
    }


    public function test() {
        // your code here
        // use $this->view to render the HTML
        return 'sike';
    }

    public function indexAction (Request $request, Response $response, $arg)
    {
        return $this->view->render($response, 'contact.html.twig', ['title' => 'Home again']);
    }

    public function pageAction (Request $request, Response $response, $data)
    {
        if ($request->getAttribute('title') !== null || !$this->title) {
//            if(!this)
            $stmt = $this->pdo->prepare('SELECT * FROM docs WHERE title');
        }
        return $this->view->render($response, 'contact.html.twig', ['title' => 'Home again']);
    }

    public function category (Request $request, Response $response, $args)
    {
        $pdo = $this->container->get('pdo');
        $cat = str_replace('_', ' ', $request->getAttribute('category'));
        $data['breadcrum'][] = ['name' => $cat, 'link' => '/'.$cat.'/'];
        $this->title = $request->getAttribute('title') !== null ? $request->getAttribute('title') : null;
        if ($this->title !== null) {
            // Not an index page
            return $this->pageAction($request, $response, $data);
        }
        $sql = 'SELECT * FROM docs WHERE JSON_SEARCH(category, \'all\', :cat) IS NOT NULL';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cat' => $cat]);
        $result = $stmt->fetchAll();

        die(print_r($result, true));
        return $this->view->render($response, 'index.html.twig', ['title' => 'Home again']);
    }

    public function aboutIndex (Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'goals.html.twig', ['title' => 'My Goals']);
    }

    private function removeUnderScore(str $string)
    {
        return str_replace('_', ' ', $string);
    }
}