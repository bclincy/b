<?php
namespace App\Entity;

use Doctrine\ORM\EntityRepository;
use App\Entity\States;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Psr\Container\ContainerInterface;

/**
* StateRepository
*
*/
class StateRepository extends EntityRepository
{
    /**
     * @return mixed
     */
    public function getMichigan()
    {
        return ['michigan', 'mi', 'Winter Wonderland'];
    }

}