<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/14/17
 * Time: 3:14 PM
 */

namespace App\Controllers;


use App\Controller\Controller;
use App\Entity\Docs;
use App\Entity\Podcast;
use App\Entity\Post;
use App\Entity\States;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class DefaultController
 * @package App\Controllers
 */
class AdminController extends Controller
{

    /**
     * AdminController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }


    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function indexAction(Request $request, Response $response)
    {
        $docs = $this->em->getRepository(States::class)->findAll();
        $data = ['page' => $docs, 'title' => 'Admin'];
        return $this->twig->render($response, 'admin/docs.html.twig', $data);
    }

    /**
     * @param Request $req
     * @param Response $res
     * @param array $args
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function editDocs(Request $req, Response $res, array $args)
    {
        $docs = $this->em->getRepository(Docs::class)->findOneBy(['id' => $args['id']]);
        $data = ['page' => $docs->toArray(), 'title' => $docs->getTitle()];

        return $this->twig->render($res, 'admin/docs.html.twig', $data);
    }

    public function jobleads(Request $req, Response $res): Response
    {

    }
}