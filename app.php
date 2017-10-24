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
$app->run();