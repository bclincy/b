<?php

namespace app\Controller;

use Exception;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as view;
use GuzzleHttp\Client as Client;

/**
 * Class HomeController
 * @package app\Controller
 */
class HomeController
{
    protected $container;
    protected $title;
    protected $cat;
    protected $pdo;
    protected $valid = ['title', 'content'];
    protected $content;
    protected $image;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $container->get('view');
        $this->pdo = $container->get('pdo');
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

    public function pageAction (Request $request, Response $response, $data = null)
    {
        if ($request->getAttribute('title') !== null || !$this->title) {
            try {
                $title = empty($this->title) ? $request->getAttribute('title') : $this->title;
                $sql = 'SELECT * FROM docs WHERE title like :title || docName like :title';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':title' => '%' . $title . '%']);
                $content = $stmt->fetchAll();
                if (isset($content[0])){
                    $content = $content[0];
                } else {
                    $notFoundHandler = $this->container->get('notFoundHandler');
                }
                if (is_array($content)) {
                    $this->content = $content;
                    $this->content['breadcrum'] = $data['breadcrum'] !== null ? $data['breadcrum'] : null;
                }
            } catch (\Exception $e) {
                $notFoundHandler = $this->container->get('notFoundHandler');
            }
        } else {
            $notFoundHandler = $this->container->get('notFoundHandler');
        }
        if (isset($notFoundHandler)) {
            return $notFoundHandler($request, $response);
        }
        $this->buildContent($this->content);


        return $this->view->render($response, 'default.html.twig', $content);
    }

    public function category (Request $request, Response $response, $args)
    {
        $pdo = $this->container->get('pdo');
        $this->cat= ucwords(str_replace('_', ' ', $request->getAttribute('category')));
        $data['breadcrum'][] = ['name' => $this->cat, 'link' => '/'.$this->cat.'/'];
        $this->title = $request->getAttribute('title') !== null ? ucwords($request->getAttribute('title')) : null;
        if ($this->title !== null) {
            // Not an index page
            return $this->pageAction($request, $response, $data);
        }
        $sql = 'SELECT * FROM docs WHERE JSON_SEARCH(category, \'all\', :cat) IS NOT NULL';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cat' => $this->cat]);
        $result = $stmt->fetchAll();

        return $this->view->render(
            $response,
            'index.html.twig',
            ['title' => $this->cat, 'data' => $result]
        );
    }

    public function aboutIndex (Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'goals.html.twig', ['title' => 'My Goals', 'data' => $args]);
    }

    private function removeUnderScore($string)
    {
        return str_replace('_', ' ', $string);
    }

    private function addUnderScore($str)
    {
        return str_replace(' ', '_', $str);
    }

    private function buildContent($data)
    {
        $this->content['url'] = isset($this->content['title']) ? $this->createCanonicalUrl($this->content['title']) :
            null;
        $this->content['image'] = $this->openGraphImage();

    }

    private function openGraphImage ()
    {
        if ($this->content['content'] !== null) {
            $images = preg_match_all(
                '|<img.*?src=[\'"](.*?)[\'"].*?>|i',
                $this->content['content'],
                $matches
            );
            $imgurl = $_SERVER['HTTP_HOST'] . $matches[ 1 ][ 0 ];
            $this->image = strlen($imgurl) !== null ? $imgurl : $_SERVER['HTTP_HOST'] . '/images/brianclincy-type.png';
        }

        //Return false if use the default image
        return $_SERVER['HTTP_HOST'] . '/images/brianclincy-type.png' == $this->image ? false: true;
    }

    private function createCanonicalUrl ($title)
    {
        //This is direct contact link
        $title = stristr($title, '_') ? $title : $this->addUnderScore($title);

        return '/pages/'.$title;
    }

    private function postFrom()
    {
        $client = new Client();
        $resp = $client->request('GET', 'http://' . $apiUrl . '/' .$resource);
    }

    private function contact(Request $request, Response $response)
    {
        die('<pre>'. print_r($request));

    }
}