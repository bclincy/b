<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/14/17
 * Time: 3:14 PM
 */

namespace app\Controllers;


use app\Controller\Controller;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use app\Authorization\Encryptor;

class DefaultController extends Controller
{


    /**
     * DefaultController constructor.
     */
    public function __construct(ContainerInterface $container)
    {

    }

    public function indexAction(Request $request, Response $response)
    {
        return 'Home Controller';
    }
}