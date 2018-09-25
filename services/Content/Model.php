<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/17/18
 * Time: 6:42 AM
 */

namespace App\Content;




use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class Model
{
    /** @var  ContainerInterface */
    private $container;

    /** @var  \PDO */
    private $pdo;

    /** @var  array  */
    private $error;

    /**
     * Model constructor.
     * @param ContainerInterface $container
     * @param \PDO $pdo
     */
    public function __construct(ContainerInterface $container, \PDO $pdo)
    {
        $this->container = $container;
        $this->pdo = $pdo;
    }


}