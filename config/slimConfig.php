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
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
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
$container['transport'] = function ($c) {
    $transport = (new \Swift_SmtpTransport('mail.brianclincy.com', 587))
        ->setUsername('info@brianclincy.com')
        ->setPassword('bcuz1Isb');
    return $transport;
};
$container['gtoken'] = function ($container) {
    $client = new Google_Client();
    $client->setApplicationName("Client_Library_Examples");
    $client->setDeveloperKey("YOUR_APP_KEY");
};
$container['apiUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/api';
$container['gApiKey'] = 'AIzaSyB5MApUbB0ybehwTXEOaPA4HK3UOSrZqus';
$container['flickrAPI'] = function ($c) {
    return ['key' => '3cb4db5f180e9b695885e5f70e25c079',
        'secret' => '027212d889b2c742'];
};