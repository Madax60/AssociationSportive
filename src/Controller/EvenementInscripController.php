<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementInscripController extends AbstractController
{
    /**
     * @Route("/evenement/inscrip", name="evenement_inscrip")
     */
    public function index(): Response
    {
        return $this->render('evenement_inscrip/index.html.twig', [
            'controller_name' => 'EvenementInscripController',
        ]);
    }
}
