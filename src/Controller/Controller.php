<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 3/2/18
 * Time: 8:56 AM
 */

namespace app\Controller;


use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Interop\Container\ContainerInterface;

/**
 * Class Controller
 * @package app\Controller
 */
class Controller
{
    /** @var ContainerInterface  */
    public $container;

    /** @var \PDO */
    public $pdo;

    /** @var \Monolog\Logger */
    public $logger;

    /** @var \Slim\Views\Twig */
    public $twig;


    /**
     * Controller constructor.
     * @param Container $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        try {

            /** services that are needed through out the controllers */
            $this->pdo = $container->get('pdo');
            $this->logger = $container->logger;
            $this->twig = $container->get('view');
        } catch (\Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function error($msg)
    {
        return $this->views->render($this->resp, '404.html', [])->withStatus(404);
    }


}