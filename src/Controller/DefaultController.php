<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/14/17
 * Time: 3:14 PM
 */

namespace app\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;
use app\Authorization\Encryptor;

class DefaultController
{

    public function indexAction(Request $request, Response $response)
    {
        die('made it here');
    }
}