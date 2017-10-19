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

$app->get('/nnuts/{id}', function (Request $request, Response $response) {
    $name = $request->getAttribute('id');
    $stmt = $this->pdo->prepare('SELECT * FROM podcast WHERE id = :id');
    $stmt->execute();
    $this->logger->addInfo('Docs get by Id');
    $name = $request->getAttribute('name');

    $response->getBody()->write('hello' . print_r($stmt, true));


    return $response;
});

$app->get('/nnuts', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();