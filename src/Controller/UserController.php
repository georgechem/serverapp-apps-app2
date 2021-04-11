<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(Request $request): Response
    {

        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);
        /*
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
        }*/

        return $this->render('user/index.html.twig', [
                'form' => $form->createView(),
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordEncoderInterface $encoder):Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $user->setPassword($encoder->encodePassword($user,$user->getPassword()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/logout', name:'app_logout')]
    public function logout()
    {

    }

}
