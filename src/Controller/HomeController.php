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
    protected $cat;

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
            $title = empty($this->title) ? $request->getAttribute('title') : $this->title;
            $sql = 'SELECT * FROM docs WHERE title like :title || docName like :title';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':title' =>'%' . $title . '%']);
            $data = $stmt->fetchAll();
            die(print_r($data, true));
        }
        return $this->view->render($response, 'contact.html.twig', ['title' => 'Home again']);
    }

    public function category (Request $request, Response $response, $args)
    {
        $pdo = $this->container->get('pdo');
        $this->cat= str_replace('_', ' ', $request->getAttribute('category'));
        $data['breadcrum'][] = ['name' => $this->cat, 'link' => '/'.$cat.'/'];
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

    private function removeUnderScore(string $string)
    {
        return str_replace('_', ' ', $string);
    }

    private function addUnderScore(string $str)
    {
        return str_replace(' ', '_', $str);
    }

    private function createCanonicalUrl (string $title)
    {
        //This is direct contact link
        $title = stristr($title, '_') ? $title : $this->addUnderScore($title);

        return $this->container->get('router')->pathFor('pages', ['name'=> $title]);
    }
}