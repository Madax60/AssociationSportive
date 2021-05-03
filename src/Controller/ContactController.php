<?php

namespace App\Controller;

use App\Form\ContactType;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, Swift_Mailer $mailer)
    {
        //Je créer mon formulaire
        $form = $this->createForm(ContactType::class);
        //Je récupere leformulaire
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            //On envoie le mail
            $message = (new \Swift_Message('Email'))
                //On attribue l'expéditeur
                ->setFrom($contact['email'])
                //Destinataire
                ->setTo('projetsymfonystvincent@gmail.com')
                //Contenue
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('contact')
                    
                    ),
                    'text/html'
                )
            ;
            //On envoie le message
            $mailer->send($message);

            $this->addFlash('success', 'Email envoyé à un administrateur');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('contact/oublie_mdp.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
