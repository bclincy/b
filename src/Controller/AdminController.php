<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 10/14/17
 * Time: 3:14 PM
 */

namespace App\Controllers;


use App\Controller\Controller;
use App\Entity\Docs;
use App\Entity\States;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class DefaultController
 * @package App\Controllers
 */
class AdminController extends Controller
{

    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function indexAction(Request $request, Response $response)
    {
        $docs = $this->em->getRepository(Docs::class)->findAll();

        return $this->twig->render($response, 'admin/docs.html.twig', ['page' => $docs]);
    }
}