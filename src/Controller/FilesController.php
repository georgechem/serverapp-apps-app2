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
        $fullPath = $this->getParameter('userRoot').explode('.',$this->getUser()->getUsername())[0].'/';

        /**
         * Read user directory
         */
        $catalog = opendir($fullPath);
        $fileList = [];
        $fileInfo = [];
        while(false !== ($file = readdir($catalog))){
            if($file !== '.' && $file !== '..'){
                $fileList[] = $file;
                $filesystem->symlink($fullPath.$file, $file);
                $fileInfo[] = [
                    'size'=>filesize($fullPath.$file),
                    'fileOwner'=>$this->getUser()->getUsername(),
                    'fileLink'=>$filesystem->readlink($file),
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
