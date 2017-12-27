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


    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var mixed|\PDO
     */
    protected $pdo;

    protected $view;

    protected $error;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->pdo = $this->container->pdo;
    }
    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return mixed
     */
    public function contactFrm (Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        return $response->withJson($data)->withHeader('Content-Type', 'application/json');
    }

    public function test()
    {
        echo 'noal';
        die('hello');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function newsSignup(Request $request, Response $response)
    {
        $body = $request->getBody();
        $data = ['fname'=>'Brian', 'lname'=>'clincy'];

        return $response->withJson($data)->withHeader('Content-Type', 'application/json');
    }

    public function restErrors($msg)
    {
        switch ($msg['code']) {
            case 400:
                $data = ['msg' => 'Bad Request, check data', 'code' => 400];
                break;
            case 401:
                $data = ['msg' => 'Unauthorized please check your credentials', 'code' => 401];
                break;
            case 404:
                $data = ['msg' => 'The Resources requested does not exists', 'code' => 404];
                break;
            case 402:
                $data = ['msg' => 'Parameters were valid but the request failed', 'code' => 402];
                break;
            case 429:
                $data = ['msg' => 'Too many request hit the API in concession', 'code' => 429];
                break;
            case 500:
                $data = ['msg' => 'Internal Server error our side is down', 'code' => 500];
                break;
            default:
                $data['msg'] = 'System is currently down please try again later';
        }

        $data['error'] = $msg['error'];
        $data['status'] = 'Failed';
        $data['details'] = $this->error;
        return array_filter($data);

    }

}