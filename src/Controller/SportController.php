<?php

namespace App\Controller;

use App\Entity\sport;
use App\Form\sportType;
use App\Repository\sportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sport")
 */
class SportController extends AbstractController
{
    /**
     * @Route("/", name="sport_index", methods={"GET"})
     */
    public function index(SportRepository $sportRepository): Response
    {
        return $this->render('sport/index.html.twig', [
            'sports' => $sportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sport_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        //On instancie un nouvel sport
        $sport = new Sport();
        //Méthode qui génere le form
        $form = $this->createForm(sportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sport);
            $entityManager->flush();

            return $this->redirectToRoute('sport_index');
        }

        return $this->render('sport/new.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sport_show", methods={"GET"})
     */
    public function show(Sport $sport): Response
    {
        return $this->render('sport/show.html.twig', [
            'sport' => $sport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, sport $sport): Response
    {
        $form = $this->createForm(sportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sport_index');
        }

        return $this->render('sport/edit.html.twig', [
            'sport' => $sport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sport_delete", methods={"DELETE"})
     */
    public function delete(Request $request, sport $sport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sport_index');
    }
}
