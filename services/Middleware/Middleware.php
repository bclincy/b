<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/12/18
 * Time: 1:38 PM
 */

namespace App\Middleware;


use Psr\Container\ContainerInterface;
use Slim\Container;

class Middleware
{
    public $container;

    public function __construct(ContainerInterface $container)
    {

    }

}