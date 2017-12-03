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

require_once 'conf/slimConfig.php';

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('resources/views', ['cache' => false, ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};
$container['NotFoundHandler'] = function ($c) {
    return new app\Controller\notFoundErrors($c->get('view'), function ($request, $response) use ($c) {
        return $c['response']
            ->withStatus(404);
    });
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
$app->get('/hop', 'HomeController:indexAction');

$app->get('/{category}/{title}', 'HomeController:category' );
$app->run();