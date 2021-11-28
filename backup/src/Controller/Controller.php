<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 3/2/18
 * Time: 8:56 AM
 */

namespace App\Controller;


use Doctrine\ORM\EntityManager;
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

    /** @var  EntityManager */
    public $em;

    /** @var  \App\Validation\Validator $validator */
    protected $validator;

    protected $breadcrum = [
      'about' =>
        ['vision'=>
          ['Home' => '<a href="/">Home</a>', 'vision' => 'Vision']
        ]
    ];


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
            $this->pdo = $container->pdo;
            $this->logger = $container->logger;
            $this->twig = $container->view;
            $this->em = $container->EntityManger;
            $this->validator = $container->validator;
        } catch (\Exception $e) {
            $this->container->logger->addError('fail to setup Controller');
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function error($msg)
    {
        return $this->twig->render('404.html', ['msg'=> $msg])->withStatus(404);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function sendmail(array $data)
    {
        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($this->container->transport);
        $data['message'] = strip_tags($data['message'], '<h1><h2><h3><br><p><a><ul><li><div>');
        // Create a message
        $message = (new \Swift_Message($data['subject']))
          ->setFrom(['info@brianclincy.com' => 'Brian'])
          ->setTo(['bclincy@gmail.com', 'info@brianclincy.com' => 'Brian Clincy'])
          ->setBody($data['message'], 'text/html')
          ->addPart(strip_tags($data['message']), 'text/plain');

        // Send the message
        return $mailer->send($message);

    }

    public function ucfuture(Request $request, Response $response)
    {

    }

}