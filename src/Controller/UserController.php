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
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
        }
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
            'error'=> $error
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordEncoderInterface $encoder, AuthenticationUtils $authenticationUtils):Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            // check is user already exists
            $em = $this->getDoctrine()->getManager();
            $alreadyUser = $em->getRepository(User::class)->findOneBy([
                'email'=>$user->getEmail()
            ]);
            if($alreadyUser){
                $request->getSession()->set(
                    Security::AUTHENTICATION_ERROR,
                    'User already exist',
                );
            }else{
                $user->setPassword($encoder->encodePassword($user,$user->getPassword()));
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
        }
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
            'error'=>$error,
        ]);
    }

    #[Route('/logout', name:'app_logout')]
    public function logout()
    {

    }

}
