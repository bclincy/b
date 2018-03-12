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

/**
 * Class DefaultController
 * @package app\Controllers
 */
class DefaultController extends Controller
{


    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function indexAction(Request $request, Response $response)
    {
        return 'Home Controller';
    }
}