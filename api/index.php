<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../conf/slimConfig.php';
$container['apiStatus'] = [
    'erorr' => ['code' => [400 => 'Bad Request']]
];


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

$app->post('newsletter/{id}', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $ticket_data = [];
    $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);
});

$app->run();
