<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/14/17
 * Time: 3:14 PM
 */

namespace App\Controllers;


use App\Controller\Controller;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Authorization\Encryptor;

/**
 * Class DefaultController
 * @package app\Controllers
 */
class DefaultController extends Controller
{
    /** @var  ContainerInterface */
    private $container;

    /**
     * DefaultController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


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