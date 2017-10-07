<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../conf/slimConfig.php';

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

$app->get('/docs/{id}', function (Request $request, Response $response) {
			$name = $request->getAttribute('id');
			$stmt = $this->pdo->prepare('SELECT * FROM docs');
			$stmt->execute();
			$this->logger->addInfo('Docs get by Id');
			$name = $request->getAttribute('name');

	    $response->getBody()->write($name);


	    return $response;
});


$app->run();
