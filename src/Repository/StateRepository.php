<?php
namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use App\Entity\States;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

/**
* StateRepository
*
*/
class StateRepository extends EntityRepository
{


    /**
     * StateRepository constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container['EntityManger'], States::class);
    }


}