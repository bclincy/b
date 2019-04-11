<?php

namespace App\Controller;

use App\Content\Display;
use App\Content\FbCrawler;
use App\Content\UserLookup;
use App\Entity\Docs;
use App\Entity\Podcast;
use App\Models\Message;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use Interop\Container\ContainerInterface;
use Slim\Http\Body;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig as twig;
use GuzzleHttp\Client as Client;
use App\Content\imageProcess as Img;
use App\Models\State;
use App\Models\Contact;
use App\Validation\Validator;
use Respect\Validation\Validator as v;


/**
 * Class HomeController
 * @package app\Controller
 */
class HomeController extends Controller
{
    /** @var string title */
    protected $title;

    /** @var string cat */
    protected $cat;

    /** @var array */
    protected $valid = ['title', 'content'];

    /** @var string */
    protected $content;

    /** @var string */
    protected $meta = '';

    /** @var array */
    protected $image;

    /** @var  Display */
    protected $displaySvc;


    /**
     * HomeController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }


    public function index(Request $req, Response $resp)
    {
        return $this->container->view->render($resp, 'homepage.html.twig', ['title' => 'Hello']);
    }

    public function displayMessage(Request $req, Response $res)
    {
        //Todo: url encoded to make it expand the form data
        $content = $this->container->db::table('messages')->where('name', 'contactFrm')->first();
        $data['title'] = 'Getting your message. You are awesome!';
        $data['content'] = $content->message;
        $data['breadcrum'] = ['<a href="/contact">Contact</a>', 'Message Sent'];

        return $this->twig->render($res, 'default.html.twig', $data);
    }

    /**
     * @return string
     */
    public function test()
    {
        // your code here
        // use $this->view to render the HTML
        $fb = new FbCrawler('https://www.facebook.com/clincy', new Client());
        $grab = new UserLookup();
        $grab->searchNames('cecilia', 'Castaneda');

        return 'sike';
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function contact(Request $request, Response $response)
    {
        $data = ['title' => 'Contact Clincy', 'breadcrum' => ['Contact']];
        return $this->twig->render($response, 'contact.html.twig', $data);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface|static
     */
    public function contactPost(Request $request, Response $response)
    {
        $gvalid = $this->container->flash->getMessages();
        $required = [
          'fname' => v::length(3)->notEmpty(),
          'lname' => v::length(3)->notEmpty(),
          'email' => v::notEmpty()->noWhitespace()->email(),
          'subject' => v::notEmpty()->noWhitespace()->length(3),
          'message' => v::notEmpty()->length(3)
        ];
        $validate = $this->container->validator->validate($request, $required);
        if (!$validate->failed() && !isset($gvalid['captcha'][0])) {
            $contact = Contact::create([
              'fname' => ucwords($request->getParam('fname')),
              'lname' => ucwords($request->getParam('lname')),
              'subject' => $request->getParam('subject'),
              'message' => $request->getParam('message'),
              'email' => $request->getParam('email'),
              'recievedOn' => time()
            ]);
        } else {
            $return['form'] = $validate->getErrors();
            $return['form']['captcha'] = $gvalid['captcha'][0];
        }
        if (isset($contact) && $contact->id > 0) {
            $_SESSION['person'] = $contact;

            return $response->withStatus(302)->withHeader('Location', '/message');
        }
        $data = ['title' => 'Contact Clincy', 'breadcrum' => ['Contact'], 'errors' => $return['form']];

        return $this->twig->render($response, 'contact.html.twig', $data);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param null $data
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function pageAction(Request $request, Response $response, $data = null)
    {
        if ($request->getAttribute('title') !== null || !$this->title) {
            try {
                $title = empty($this->title) ? $request->getAttribute('title') : $this->title;
                $sql = 'SELECT * FROM docs WHERE title like :title || docName like :title';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':title' => '%' . $title . '%']);
                $content = $stmt->fetchAll();
                if (isset($content[0])) {
                    $content = $content[0];
                } else {
                    $notFoundHandler = $this->container->get('notFoundHandler');
                }
                if (is_array($content)) {
                    $this->content = $content;
                    $this->content['breadcrum'] = $data['breadcrum'] !== null ? $data['breadcrum'] : null;
                }
            } catch (\Exception $e) {
                $notFoundHandler = $this->container->notFoundHandler;
            }
        } else {
            $notFoundHandler = $this->container->notFoundHandler;
        }
        if (isset($notFoundHandler)) {
            return $notFoundHandler($request, $response);
        }
        $this->buildContent($this->content);


        return $this->twig->render($response, 'default.html.twig', $content);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function category(Request $request, Response $response, $args)
    {
        $this->cat = ucwords(str_replace('_', ' ', $request->getAttribute('category')));
        $data['breadcrum'][] = ['name' => $this->cat, 'link' => '/' . $this->cat . '/'];
        $this->title = $request->getAttribute('title') !== null ? ucwords($request->getAttribute('title')) : null;
        if ($this->title !== null) {
            // Not an index page
            return $this->pageAction($request, $response, $data);
        }
        $cat = "%{$this->cat}%";
        $sql = 'SELECT * FROM docs WHERE category like :cat';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['cat' => $cat]);
        $result = $stmt->fetchAll();

        return $this->twig->render(
          $response,
          'category.html.twig',
          ['title' => $this->cat, 'data' => $result, 'breadcrum' => '']
        );
    }

    public function gallery(Request $req, Response $res)
    {
        $this->displaySvc = $this->container->Display;
        $images = $this->displaySvc->galleryOptions('gallery', $_SERVER['DOCUMENT_ROOT'],
          $req->getAttribute('rewrite'));
        return $this->twig->render($res, 'gallery.html.twig', ['title' => 'Clincy Gallery', 'img' => $images]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function aboutIndex(Request $request, Response $response, $args)
    {
        return $this->twig->render($response, 'goals.html.twig', ['title' => 'My Goals', 'data' => $args]);
    }

    public function nnutsByName(Request $request, Response $response)
    {


        return $response;
    }

    /**
     * @param Request $req
     * @param Response $resp
     * @return object
     */
    public function resumeFrm(Request $req, Response $resp, $args)
    {
        if (isset($args['id'])) {
            if ($this->container->Display->authorize($args['id']) === false) {
                $this->container->flash->addMessage('EnterForm', 'Please first fill out the form');
                $data = [
                  'title' => 'Please Complete form',
                  'error' => 'Please fill out the form to continue',
                  'breadcrum' => ['<a href="/resume">Hire Me</a>']
                ];
                $template = 'hireme/resumeReq.html.twig';
            } else {
                $data = ['title' => 'Brian Clincy Resume'];
                $template = 'hireme/resume.html.twig';
            }
        } else {
            $data = ['title' => 'Resume Request', 'breadcrum' => ['Hire Me', 'Resume Request']];
            $template = 'hireme/resumeReq.html.twig';
        }

        return $this->twig->render($resp, $template, $data);
    }

    /**
     * @param $string
     * @return mixed
     */
    private function removeUnderScore($string)
    {
        return str_replace('_', ' ', $string);
    }

    /**
     * @param $str
     * @return mixed
     */
    private function addUnderScore($str)
    {
        return str_replace(' ', '_', $str);
    }


    public function show(Request $request, Response $response)
    {
        $content = $this->container->Display->searchDocs($request->getAttribute('slug'));

        return $this->twig->render($response, 'default.html.twig', $content);
    }

    public function nnuts(Request $req, Response $resp)
    {
        die('here world');
    }

    public function nnutsById(Request $request, Response $response)
    {
        $data = $this->postFrom('/nnuts/' . $request->getAttribute('id'));
        echo '<pre>' . print_r($data, true);
    }

    private function postFrom($resource)
    {
        $client = new Client();
//        die($this->container->get('apiUrl'). );
        $resp = $client->request('GET', $this->container->apiUrl . $resource);
        $data = json_decode($resp->getBody(), true);

    }

    public function nnutsIndex(Request $request, Response $response)
    {
        $youtube = new \App\Content\youtubeListing('youngbmale', new \GuzzleHttp\Client(), $_ENV['GOOGLE_API']);
        $youtube = $youtube->init();
        $podcasts = $this->em->getRepository(Podcast::class)->findAll();
        $data = [];
        die('<pre>' . print_r($podcasts, true));
        return $this->twig->render($response, 'home/new.html.twig', ['content' => 'NNUTS podcast']);
    }

    public function advisoryBoard()
    {

    }

    public function nnutsRssFeeds(Request $req, Response $res)
    {
        $podcasts = $this->em->getRepository(Podcast::class)->findAll();
        $content = new \App\Content\Podcast($this->em);
        $xml = $content->rssFeed($podcasts);
        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($xml->asXML());

        return $res->withHeader('Content-type', 'application/xml')
          ->withBody($body);
    }
}