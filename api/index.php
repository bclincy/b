<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \app\Controller\ApiController as API;

require '../config/slimConfig.php';
$container['apiStatus'] = [
    'codes' =>
    [400 => ['title' => 'Bad Request', 'msg' => 'The resource requested is not exists or no longer available']],
    [401 => ['title' => 'Unauthorized Request', 'msg' => 'Unauthorized please check your credentials']],
    [404 => ['title' => 'Resource Not Found', 'msg' => 'The Resources requested does not exists']],
    [402 => ['title' => 'Invalid Request', 'msg' => 'Parameters were valid but the request failed']],
    [429 => ['title' => 'Exceeded Resource Limits','msg' => 'Too many request hit the API in concession or reach request limit' ]],
    [500 => ['title'=> 'Server Error', 'msg' => 'Internal Server error our side is down' ]]
];
$container['ApiController'] = function (\Slim\Container $container) {
    return new \app\Controller\ApiController($container);
};

$container['hasAccess'] = function (\Slim\Container $container) {
    $container->environment;
    // Todo: This authenticate users of the API for now return true
    return true;
};

$app->get('/hello/{name}', function (Request $request, Response $response) {
	    $name = $request->getAttribute('name');
	    $response->getBody()->write("Hello, $name");

	    return $response;
});

$app->get('/', function (Request $request, Response $response) {
	    $name = $request->getAttribute('name');
	    $response->getBody()->write("Hello, $name");
			// $this->logger->addInfo('called root');

	    return $response;
});

$app->options('/docs/{key}/{num}', function (Request $request, Response $response, $args) {
	$hasArgs = $args !== null ? $args : false;
    $key = $request->getAttribute('key');
	$stmt = $this->pdo->prepare('SELECT * FROM docs');
	$stmt->execute();
    $data = json_encode($stmt->fetchall());
    $this->logger->addInfo('Docs get by Id');
    $response = $response->withJson($data, 201);

	return $response;
});

$app->get('test/{me}', 'ApiController:test');

$app->post('/newsletter/{id}', function (Request $request, Response $response) {
   die($request->getParsedBody());
   return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});
$app->post('docs/{id}', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $ticket_data = [];
    $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
});

//$app->post('/contact/', 'ApiController:contactFrm');
//$app->post('/contact/', function (Request $request, Response $response) {
//    $data = $request->getParsedBody();
//    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
//});
$app->post('/contact/', 'ApiController:contact');
$app->get('/nnuts/{id}', function($request, $response){ die('hello world');});

$app->run();
