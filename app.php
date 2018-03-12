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
use app\Content\youtubeListing as yt;
use app\Authorization\Encryptor as encrypt;
use app\Authorization\GoogleToken;
use app\Repository\Shoutouts as shoutout;

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
$container['Controller'] = function (\Slim\Container $container) {
    return new \app\Controller\Controller($container);
};

$container['HomeController'] = function (\Slim\Container $container) {
    return new \app\Controller\HomeController($container);
};

$app->get('/nnuts/{id}', 'HomeController:nnutsById');

$app->get('/nnuts/episode/{name}', function (Request $request, Response $response) {
    $name = '%' . $request->getAttribute('name') . '%';
    $query = $this->pdo->prepare('SELECT * FROM podcast where title like :name');
    $query->execute([':name' => $name]);
    $results = $query->fetchall();
    $response->getBody()->write(print_r($results, true));

    return $response;
});
$app->get('/shoutouts', function (Request $request, Response $response) {
    $shoutout = new shoutout($this->pdo);
    $results = print_r($shoutout->select(), true);
    $name = '%' . $request->getAttribute('name') . '%';
//    $query = $this->pdo->prepare('SELECT * FROM Shoutouts where title like :name');
//    $query->execute([':name' => $name]);
//    $results = $query->fetchall()[0];
    die('<pre>' . print_r($results, true));
    $response->getBody()->write('');

    return $response;
});

$app->get('/home', function (Request $request, Response $response){
    return $this->view->render($response, 'index.html.twig', ['title' => 'Home again']);
});

$app->get('/resume', function (Request $request, Response $response) {
    return $this->view->render($response, 'resume.html', [$request]);
});

$app->get('/callback/{service}/{key}', function (Request $request, Response $response) {

    die('<pre>' . print_r($request, true));
    return $this->view->render($response, 'advisorySignup.html.twig', ['title'=> 'Advisory Board', 'data' => $request]);
});
$app->get('/testme', function (Request $request, Response $response) {
//    $youtube = new yt('youngbmale', new \GuzzleHttp\Client(), $this->gApiKey);
//    $youtube = $youtube->init();
//    $str = encrypt::decryptStr($youtube['hash']);
//    $fight = new GoogleToken();
//    $fight->init();
    return $this->view->render($response, 'advisorySignup.html.twig', ['title'=> 'Advisory Board', 'data' => $request]);
});
$app->get('/gallery/','HomeController:gallery');
$app->get('/{slug}', 'HomeController:show');
$app->get('/{category}/', 'HomeController:category' );
$app->run();
