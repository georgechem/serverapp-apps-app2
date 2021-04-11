<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class FilesController extends AbstractController
{
    #[Route('/showFiles', name: 'app_show_files')]
    public function index(Filesystem $filesystem): Response
    {
        /**
         * Get Root Directory for All Users
         * Get Specific Folder for certain User
         * Combine Full Path for User specific files
         */
        //$fullPath = $this->getParameter('userRoot').explode('.',$this->getUser()->getUsername())[0].'/';
        $path = './users/'.explode('.',$this->getUser()->getUsername())[0].'/';
        /**
         * Read user directory
         */
        $catalog = opendir($path);
        $fileList = [];
        $fileInfo = [];
        while(false !== ($file = readdir($catalog))){
            if($file !== '.' && $file !== '..'){
                $fileList[] = $file;
                //$filesystem->symlink($fullPath.$file, '/users/'.$file);
                $fileInfo[] = [
                    'size'=>filesize($path.$file),
                    'fileOwner'=>$this->getUser()->getUsername(),
                    'fileLink'=>$path.$file,
                ];
            }
        }
        closedir($catalog);
        /**
         * Get additional info about files
         */

        return $this->render('files/index.html.twig', [
           'files' => $fileList,
            'fileInfo'=>$fileInfo,
        ]);
    }
}
