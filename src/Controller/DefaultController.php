<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route(path="/accueil", name="accueil", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository): Response
    {

        $message = 'Derniers évènements';

        return $this->render('default/index.html.twig', [ 
            'evenements' => $evenementRepository->findAll(),
        ]);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'message' => $message,
        ]);
    }

}
