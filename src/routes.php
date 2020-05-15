<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Content\Podcast;

// Routes

$app->get('/', 'HomeController:index')->setName('home');
$app->group('/contact', function () {
    $this->get('[/]', 'HomeController:contact')->setName('contact');
    $this->post('[/]', 'HomeController:contactPost');
})->add(new \App\Middleware\Csfr($container));

$app->group('/nnuts', function () {
//    $this->get('', 'HomeController:nnutsIndex')->setName('plist');
    $this->get('[/]', 'HomeController:nnutsIndex')->setName('podcast');
    $this->get('/nnuts/episode/{name}', 'HomeController:nnutsByName')->setName('nnutsByName');
    $this->get('/nnuts/{id}', 'HomeController:nnutsById')->setName('nnutsids');
    $this->get('/rss', 'HomeController:nnutsRssFeeds')->setName('rssFeed');
});
$app->group('/NNUTS', function () {
//    $this->get('', 'HomeController:nnutsIndex')->setName('plist');
    $this->get('[/]', 'HomeController:nnutsIndex')->setName('podcast');
    $this->get('/nnuts/episode/{name}', 'HomeController:nnutsByName')->setName('nnutsByName');
    $this->get('/nnuts/{id}', 'HomeController:nnutsById')->setName('nnutsids');
    $this->get('/rss', 'HomeController:nnutsRssFeeds')->setName('rssFeed');
});
$app->group('/admin', function() {
    $this->get('[/]', 'AdminController:indexAction')->setName('admin');
    $this->get('/docs/edit/{id}', 'AdminController:editDocs')->setName('edit-docs');
})->add(new \App\Middleware\Csfr($container));

$app->get('/shoutouts', function (Request $request, Response $response) {
    $response->getBody()->write('I get busy over here');
    return $response;
});

$app->group('/resume', function () {
    $this->get('/{id}', 'HomeController:resumeFrm')->setName('resumeFrm');
    $this->get('[/]', 'HomeController:resumeFrm')->setName('resume');
})->add(new App\Middleware\Csfr($container));

/** API */
$app->group('/api', function () {
    $this->get('/nnuts/{id}', 'ApiController:nnutsById');
    $this->get('/podcasts', function (Request $req, Response $resp) {
        $new = new Podcast($this->EntityManger);
        return $resp->withJson($new->displayPodcast());
    });
    $this->post('/contact/', 'ApiController:contactFrm')->setName('apiContact');
    $this->post('/newsletter/{email}', 'ApiController:newsSignup')->setName('newsletter');
    $this->post('/resume/new', 'ApiController:resume')->setName('newResumeFrm');
    $this->post('/shoutout/add', 'ApiController:addShoutout')->setName('addShoutout');
})->add(new App\Middleware\Csfr($container));


$app->get('/callback/{service}/{key}', function (Request $request, Response $response) {
    die('<pre>' . print_r($request, true));
    return $this->view->render($response, 'advisorySignup.html.twig',
      ['title' => 'Advisory Board', 'data' => $request]);
});

$app->get('/test[/{data}]', 'HomeController:test');
$app->get('/message[/{data}]', 'HomeController:displayMessage');

$app->get('/testme', function (Request $request, Response $response) {
    $youtube = new \App\Content\youtubeListing('youngbmale', new \GuzzleHttp\Client(), $_ENV['GOOGLE_API']);
    $youtube = $youtube->init();
    echo '<pre>' . print_r($youtube, true) . '</pre>';

//    $str = encrypt::decryptStr($youtube['hash']);
//    $fight = new \App\Authorization\GoogleToken();
//    $fight->init();
    return $this->view->render($response, 'advisorySignup.html.twig',
      ['title' => 'Advisory Board', 'data' => $request]);
});

$app->get('/advisoryBoard', 'homeController:advisor')->setName('advisory');
$app->group('/gallery', function() {
 $this->get('[/]', '\App\Controller\HomeController:gallery')->setName('gallery');
 $this->get('/{rewrite}', '\App\Controller\HomeController:gallery')->setName('Imgrewrite');
});
$app->get('/{category}/', 'HomeController:category')->setName('category');
$app->get('/{slug}', 'HomeController:show')->setName('pages');
