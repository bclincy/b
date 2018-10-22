<?php
use App\Entity\DocRepository;
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
    $pdo = new \PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['database'],
        $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates/', [
        'cache' => $_ENV['APP_ENV'] === 'dev' ? false : true,
        'debug'=> $_ENV['APP_ENV'] === 'dev',
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
    $view->getEnvironment()->addGlobal("request", $_REQUEST);

    return $view;
};

$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['view']->render($response, '404.html', [])->withStatus(404);
    };
};


$container['transport'] = function ($c) {
    $transport = (new \Swift_SmtpTransport('mail.brianclincy.com', 587))
        ->setUsername($_ENV['m_user'])
        ->setPassword($_ENV['m_passwd']);
    return $transport;
};

$container['gtoken'] = function ($container) {
    $client = new Google_Client();
    $client->setApplicationName("Client_Library_Examples");
    $client->setDeveloperKey("YOUR_APP_KEY");
};

$container['validator'] = function ($container) {
    return new App\Validation\Validator($container);
};

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};
/******* Doctrine Setup & Repository ********/
$container['EntityManger'] = function (\Psr\Container\ContainerInterface $container): \Doctrine\ORM\EntityManager {
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $container['settings']['doctrine']['metadata_dirs'],
        $container['settings']['doctrine']['dev_mode']
    );

    $config->setMetadataDriverImpl(
        new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
            new \Doctrine\Common\Annotations\AnnotationReader(),
            $container['settings']['doctrine']['metadata_dirs']
        )
    );

    $config->setMetadataCacheImpl(
        new \Doctrine\Common\Cache\FilesystemCache(
            $container['settings']['doctrine']['cache_dir']
        )
    );

    return \Doctrine\ORM\EntityManager::create(
        $container['settings']['doctrine']['connection'],
        $config
    );
};

$container['flickrAPI'] = function ($c) {
    return envVarsToArrays('FLICKER');
};

$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

$container['hasAccess'] = function (\Slim\Container $container) {
    $container->environment;
    // Todo: This authenticate users of the API for now return true
    return true;
};

$container['Controller'] = function (\Slim\Container $container) {
    return new \App\Controller\Controller($container);
};

$container['ApiController'] = function (\Slim\Container $container) {
    return new \App\Controller\ApiController($container);
};

$container['HomeController'] = function (\Slim\Container $container) {
    return new \App\Controller\HomeController($container);
};

$container['Display'] = function (\Slim\Container $container) {
    return new \App\Content\Display($container, $container->pdo);
};

$container['State'] = function (\Slim\Container $container)
{
    return new \App\Entity\StateRepository($container);
};

$container['baseUrl'] = function () {
    return sprintf(
      "%s://%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME']
    );
};

return $container;
