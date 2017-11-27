<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 11/17/17
 * Time: 6:22 AM
 */

namespace app\Controller;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ApiController
{


    protected $container;
    protected $pdo;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdo = $this->container->get('pdo');
    }
    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function contactFrm (Request $request, Response $response, $args)
    {

        die(print_r($request->getAttribute('category'), true));
        return $this->view->render($response, 'index.html.twig', ['title' => 'Home again']);
    }

    /**
     * @param Request $request
     * @param Respons $response
     */
    public function newsSignup(Request $request, Response $response)
    {
        $body = $request->getBody();
//    $body->write('{"your_content": "here"}');
        $data = ['fname'=>'Brian', 'lname'=>'clincy'];
        die($body);

        return $response->withJson($data)->withHeader('Content-Type', 'application/json');


    }
}