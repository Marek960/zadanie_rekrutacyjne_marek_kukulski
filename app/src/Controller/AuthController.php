<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
         #[Route('/sign-in', name: 'app_sign_in')]
         public function app_sign_in(AuthenticationUtils $authenticationUtils): Response
         {
             $error = $authenticationUtils->getLastAuthenticationError();
             $lastUsername = $authenticationUtils->getLastUsername();
     
             return $this->render('auth/sign-in.html.twig', [
                 'last_username' => $lastUsername,
                 'error'         => $error,
             ]);
         }
     
         #[Route('/sign-out', name: 'app_sign_out')]
         public function app_sign_out(): Response
         {
             throw new \Exception('Don\'t forget to activate logout in security.yaml');
         }
}
