<?php

namespace App\Notification;

use App\Entity\Message;
use Twig\Environment;
use Symfony\Component\Mime\Email;

class MessageNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer  $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Message $message)

    {
        $message = (new \Swift_Message('AssoStVincent : ' . $message->getObjet()))

            ->setFrom($message->getEmail())
            //A qui est destiné l'email
            ->setTo('tony.nguyen1999i@gmail.com')
            //A qui on va répondre
            ->setReplyTo($message->getEmail())
            ->setBody($this->renderer->render('emails/message.html.twig', [
                'message' => $message
            ]),'text/html');
        $this->mailer->send($message);

    }
}


