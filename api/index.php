<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../conf/slimConfig.php';
$container['apiStatus'] = [
    'codes' =>
        [400 => ['title' => 'Bad Request', 'msg' => 'The resource requested is not exists or no longer available']],
        [401 => ['title' => 'Unauthorized Request', 'msg' => 'Unauthorized please check your credentials']],
];
$container['ApiController'] = function (\Slim\Container $container) {
    return new \app\Controller\ApiController($container);
};

$container['hasAccess'] = function (\Slim\Container $container) {
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
	    $key = $request->getAttribute('key');
		$stmt = $this->pdo->prepare('SELECT * FROM docs');
		$stmt->execute();
        $data = json_encode($stmt->fetchall());
        $this->logger->addInfo('Docs get by Id');
        $response = $response->withJson($data, 201);

	    return $response;
});

$app->post('/newsletter/{id}', function (Request $request, Response $response) {
   $data = $request->getParsedBody();
   return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});
$app->post('docs/{id}', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $ticket_data = [];
    $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
});

$app->post('/test', 'ApiController:newsSignup');
$app->post('/contact/', function (Request $request, Response $response) {
    global $container;
//    die(print_r($container, true));
    $data = $request->getParsedBody();
    return $response->withJson($data)->withHeader('Content-Type', 'application/json');
});
//$app->post('/contact/', 'ApiController:contactFrm');

$app->run();
