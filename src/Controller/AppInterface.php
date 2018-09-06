<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 1/29/18
 * Time: 11:07 PM
 */
namespace Psr\Container;

interface appContainerInterface extends ContainerInterface {
    public function pdo($pdo);
    public function logger($logger);
    public function apiStatus($apiStatus);
}