<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 12/3/17
 * Time: 8:12 AM
 */

namespace app\Controller;


use Slim\Handlers\NotFound;
use Slim\Views\Twig;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class NotFoundErrors extends NotFound
{
    private $view;

    public function __construct(Twig $view) {
        $this->view = $view;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response) {
        parent::__invoke($request, $response);

        $this->view->render($response, '404.html');

        return $response->withStatus(404);
    }
}