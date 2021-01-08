<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Notification\MessageNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\MailerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class EmailController extends AbstractController
{
    /**
     * @Route("/oublie_motdepasse", name="app_oublie_mdp")
     * @param MailerService $mailerService
     * @param Request $request
     * @return Response
     */
    public function sendEmail(Request $request, MessageNotification $notification): Response
    {
        $message = new Message();

        // 1) build the form
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $notification->notify($message);

            $this->addFlash('success', 'Votre email a bien été envoyé');
            /*
            return $this->redirectToRoute('app_oublie_mdp');
            */
            }

        return $this->render('security/oublie_motdepasse.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
