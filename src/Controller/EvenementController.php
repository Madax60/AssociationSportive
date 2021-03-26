<?php

namespace App\Controller;

use App\Service\FileUploader;
use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/admin/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [ 
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger, FileUploader $fileUploader): Response
    {
        //On instancie un nouvel evenement
        $evenement = new Evenement();
        //Méthode qui génere le form
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochure = $form->get('brochure')->getData();
            $fichier = md5(uniqid()) . '.' . $brochure->guessExtension();

            //On copie le fichier dans le dossier upload
            $brochure->move(
                $this->getParameter('brochures_directory'),
                $fichier
            );

            //On va stocker l'image dans la BDD (son nom car déjà
            //stocker dans le projet)
            $evenement->setBrochureFilename($fichier);
            $evenement->getBrochureFilename($evenement);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochure = $form->get('brochure')->getData();
            $fichier = md5(uniqid()) . '.' . $brochure->guessExtension();

            //On copie le fichier dans le dossier upload
            $brochure->move(
                $this->getParameter('brochures_directory'),
                $fichier
            );

            //On va stocker l'image dans la BDD (son nom car déjà
            //stocker dans le projet)
            $evenement->setBrochureFilename($fichier);
            $evenement->getBrochureFilename($evenement);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_index');
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evenement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
        $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->remove($evenement);
        //     $entityManager->flush();
        $entityManager->remove($evenement);
        $entityManager->flush();
        // return new Response('SUPPRESSION');
        return $this->redirectToRoute('evenement_index');
    }
}
