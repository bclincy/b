<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../config/slimConfig.php';
$container['apiStatus'] = [
    'codes' =>[
    400 => ['title' => 'Bad Request', 'msg' => 'The resource requested is not exists or no longer available'],
    401 => ['title' => 'Unauthorized Request', 'msg' => 'Unauthorized please check your credentials'],
    404 => ['title' => 'Resource Not Found', 'msg' => 'The Resources requested does not exists'],
    402 => ['title' => 'Invalid Request', 'msg' => 'Parameters were valid but the request failed'],
    429 => ['title' => 'Exceeded Resource Limits','msg' => 'Too many request hit the API in concession or reach request limit' ],
    500 => ['title'=> 'Server Error', 'msg' => 'Internal Server error our side is down' ]
    ]
];
$container['ApiController'] = function (\Slim\Container $container) {
    return new \app\Controller\ApiController($container);
};

$container['hasAccess'] = function (\Slim\Container $container) {
    $container->environment;
    // Todo: This authenticate users of the API for now return true
    return true;
};
$app->get('/nnuts/{id}', 'ApiController:nnutsById');
$app->post('/contact/', 'ApiController:contactFrm');
$app->post('/shoutout/add', 'ApiController:addShoutout');
$app->get('/test/', function (Request $request, Response $response) {
    $attr = $request->getAttributes();
    $attr = is_array($attr) ? true : false;
    return $response->withHeader('content-type', 'application/JSON')
        ->withHeader('content-length', '8');
} );

$app->run();
