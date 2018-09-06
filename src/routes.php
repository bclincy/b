<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


$app->get('/', 'HomeController:index')->setName('home');
//$app->get('/nnuts/{id}', 'HomeController:nnutsById')->setName('nnutspcast');
$app->get('/nnuts/episode/{name}', function (Request $request, Response $response) {
    $name = '%' . $request->getAttribute('name') . '%';
    $query = $this->pdo->prepare('SELECT * FROM podcast where title like :name');
    $query->execute([':name' => $name]);
    $results = $query->fetchall();
    $response->getBody()->write(print_r($results, true));

    return $response;
});
$app->get('/shoutouts', function (Request $request, Response $response) {
    $response->getBody()->write('');

    return $response;
});

$app->get('/home', function (Request $request, Response $response){
    return $this->view->render($response, 'home/index.html.twig', ['title' => 'Home again']);
});

$app->get('/resume', function (Request $request, Response $response) {
    return $this->view->render($response, 'resume.html', [$request]);
});

$app->get('/callback/{service}/{key}', function (Request $request, Response $response) {

    die('<pre>' . print_r($request, true));
    return $this->view->render($response, 'advisorySignup.html.twig', ['title'=> 'Advisory Board', 'data' => $request]);
});
$app->get('/nnuts/{id}', 'ApiController:nnutsById');
$app->post('/contact', 'ApiController:contactFrm');
$app->post('/shoutout/add', 'ApiController:addShoutout');
$app->get('/test/', function (Request $request, Response $response) {
    $attr = $request->getAttributes();
    die('hello');
    $attr = is_array($attr) ? true : false;
    return $response->withHeader('content-type', 'application/JSON')
        ->withHeader('content-length', '8');
} );

$app->get('/testme', function (Request $request, Response $response) {
    $youtube = new \app\Content\youtubeListing('youngbmale', new \GuzzleHttp\Client(), $this->gApiKey);
    $youtube = $youtube->init();
    echo '<pre>' . print_r($youtube, true);
//    $str = encrypt::decryptStr($youtube['hash']);
    $fight = new \app\Authorization\GoogleToken();
    $fight->init();
    return $this->view->render($response, 'advisorySignup.html.twig', ['title'=> 'Advisory Board', 'data' => $request]);
});
$app->get('/gallery/','HomeController:gallery');
$app->get('/{slug}', 'HomeController:show');
$app->get('/{category}/', 'HomeController:category' );