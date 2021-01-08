<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailerService
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * MailerService constructor.
     * @param MailerInterface $mailer
     * @param Environment $twig
     */
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param string $objet
     * @param string $subject
     * @param string $from
     * @param string $to
     * @param string $template
     * @param array $parameters
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function send(string $objet, string $subject, string $from, string $to, string $template, array $parameters): void
    {
        $email = (new Email())

            //Celui qui va envoyer le mail
            ->from($from)
            //Celui qui va recevoir le mail
            ->to($to)
            //Objet
            ->objet($objet)
            //message
            ->subject($subject)
            //Template
            ->html(
                $this->twig->render($template, $parameters),
                'text/html'
            );

        //Envoie l'email
        $this->mailer->send($email);
    }
}