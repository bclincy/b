<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/14/17
 * Time: 3:14 PM
 */

namespace App\Controllers;


use App\Controller\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class DefaultController
 * @package App\Controllers
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
        $q = $request->getQueryParams();
        $response->getStatusCode();

        return 'Home Controller';
    }
}