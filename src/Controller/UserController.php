<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {

        $user = new User();
        $form = $this->createForm(LoginType::class, $user);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            dd($user);
        }

        return $this->render('user/index.html.twig', [
                'form' => $form->createView(),
        ]);
    }
}
