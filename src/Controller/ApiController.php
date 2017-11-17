<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 11/17/17
 * Time: 6:22 AM
 */

namespace app\Controller;


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ApiController
{

    public function contactFrm (Request $request, Response $response, $args)
    {

        die(print_r($request->getAttribute('category'), true));
        return $this->view->render($response, 'index.html.twig', ['title' => 'Home again']);
    }
}