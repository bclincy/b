<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

if (is_file('../vendor/autoload.php')) {
    require_once('../vendor/autoload.php');
} else {
    require_once('vendor/autoload.php');
}
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "root";
$config['db']['dbname'] = "brianclincy";

$app = new \Slim\App(['settings'=> $config]);
$container = $app->getContainer();
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("logs/myapp.log");
    $logger->pushHandler($file_handler);

    return $logger;
};

$container['pdo'] = function ($container) {
    $db = $container['settings']['db'];
    $pdo = new \PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
$container['gtoken'] = function ($container) {
    $client = new Google_Client();
    $client->setApplicationName("Client_Library_Examples");
    $client->setDeveloperKey("YOUR_APP_KEY");
};
$container['apiUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/api';
$container['gApiKey'] = 'AIzaSyB5MApUbB0ybehwTXEOaPA4HK3UOSrZqus';