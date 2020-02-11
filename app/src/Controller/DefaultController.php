<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Gaëtan Rolé-Dubruille <gaetan.role-dubruille@sensiolabs.com>
 */
final class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
