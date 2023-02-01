<?php

namespace App\Controller;

use App\Service\SendMailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/mail', name: 'app_mail')]
    public function envoiMail(SendMailService $mailer): Response
    {
        $user = $this->getUser();
        $mailer->send('moi@dwwm.fr', 'toto@dwwm.fr', 'essai de mail', 'register', compact('user'));
        return $this->render('main/index.html.twig');
    }
}
