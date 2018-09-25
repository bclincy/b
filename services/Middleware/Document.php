<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/7/18
 * Time: 9:08 AM
 */

namespace App\Middleware;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class Document
{
    /** @var  ContainerInterface */
    private $container;

    /**
     * Document constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param ServerRequestInterface $req
     * @param Response $res
     * @param callable $next
     * @return Response
     */
    public function __invoke(ServerRequestInterface $req, Response $res, callable $next)
    {
        $res = $next($req, $res);

        return $res;
    }

    public function contentExists()
    {

    }

}