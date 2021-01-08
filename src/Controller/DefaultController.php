<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route(path="/accueil", name="accueil", methods={"GET"})
     */
    public function index(): Response
    {

        $message = 'Derniers évènements';


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'message' => $message,
        ]);
    }

}
