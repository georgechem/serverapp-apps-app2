<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        /**
         * Get Root Directory for All Users
         * Get Specific Folder for certain User
         * Combine Full Path for User specific files
         */
        $fullPath = $this->getParameter('userRoot').explode('.',$this->getUser()->getUsername())[0].'/';


        return $this->render('default/index.html.twig', [

        ]);
    }
}
