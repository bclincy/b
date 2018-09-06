<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['pdo'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new \PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates/', [
        'cache' => false,
        'debug'=> true
    ]);
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->getEnvironment()->addFunction(new \Twig_SimpleFunction('asset', function ($asset) {
        // implement whatever logic you need to determine the asset path

        return sprintf('/%s', ltrim($asset, '/'));
    }));
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['view']->render($response, '404.html', [])->withStatus(404);
    };
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

$container['Controller'] = function (\Slim\Container $container) {
    return new \app\Controller\Controller($container);
};

$container['HomeController'] = function (\Slim\Container $container) {
    return new \app\Controller\HomeController($container);
};

$container['apiUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/api';

$container['gApiKey'] = 'AIzaSyB5MApUbB0ybehwTXEOaPA4HK3UOSrZqus';

$container['flickrAPI'] = function ($c) {
    return ['key' => '3cb4db5f180e9b695885e5f70e25c079',
        'secret' => '027212d889b2c742'];
};

$container['ApiController'] = function (\Slim\Container $container) {
    return new \app\Controller\ApiController($container);
};

$container['hasAccess'] = function (\Slim\Container $container) {
    $container->environment;
    // Todo: This authenticate users of the API for now return true
    return true;
};
