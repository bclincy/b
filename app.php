<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/14/17
 * Time: 3:10 PM
 */
//bootstrap slim
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr7Middlewares\Middleware;
use Slim\Views\Twig;

require_once 'config/slimConfig.php';

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('templates/', [
        'cache' => false,
        'debug'=> true
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};
$container['baseUrl'] = $_SERVER['HTTP_HOST'];
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['view']->render($response, '404.html', [])->withStatus(404);
    };
};

$container['HomeController'] = function (\Slim\Container $container) {
    return new \app\Controller\HomeController($container);
};

$app->get('/nnuts/{id}', function (Request $request, Response $response) {
    $name = $request->getAttribute('id');
    $stmt = $this->pdo->prepare('SELECT * FROM podcast WHERE id = :id');
    $stmt->execute([':id' => $name]);
    $this->logger->addInfo('Docs get by Id');

    $response->getBody()->write('hello' . print_r($stmt, true));


    return $response;
});

$app->get('/nnuts/episode/{name}', function (Request $request, Response $response) {
    $name = '%' . $request->getAttribute('name') . '%';
    $query = $this->pdo->prepare('SELECT * FROM podcast where title like :name');
    $query->execute([':name' => $name]);
    $results = $query->fetchall();
    $response->getBody()->write(print_r($results, true));

    return $response;
});
$app->get('/shoutouts', function (Request $request, Response $response) {
    $name = '%' . $request->getAttribute('name') . '%';
    $query = $this->pdo->prepare('SELECT * FROM podcast where title like :name');
    $query->execute([':name' => $name]);
    $results = $query->fetchall();
    $response->getBody()->write('');

    return $response;
});

$app->get('/home', function (Request $request, Response $response){
    return $this->view->render($response, 'index.html.twig', ['title' => 'Home again']);
});

$app->get('/resume', function (Request $request, Response $response) {
    return $this->view->render($response, 'resume.html', [$request]);
});
$app->get('/testme', function (Request $request, Response $response) {
    return $this->view->render($response, 'advisorySignup.html.twig', ['title'=> 'Advisory Board', 'data' => $request]);
});

$app->get('/contact', function (Request $request, Response $response) {
    return $this->view->render($response, 'contact.html.twig', [$request]);
});
$app->post('/contact', 'HomeController:Contact');
//$app->get('/about', 'HomeController:indexAction');

$app->get('/pages/{title}', 'HomeController:pageAction' );
$app->get('/{category}/{title}', 'HomeController:category' );
$app->get('/{category}/', 'HomeController:category' );
$app->run();