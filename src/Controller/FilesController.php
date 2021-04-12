<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class FilesController extends AbstractController
{
    #[Route('/showFiles', name: 'app_show_files')]
    public function index(): Response
    {
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
                $fileInfo[] = [
                    'size'=>filesize($path.$file),
                    'fileOwner'=>$this->getUser()->getUsername(),
                    'filename'=>$file,
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

    #[Route('/downloadFile/{filename}', name: 'app_download')]
    public function downloadFile(string $filename)
    {
        $path = './users/'.explode('.',$this->getUser()->getUsername())[0].'/';

        $file = new File($path.$filename);

        return $this->file($file);
    }

    #[Route('/displayFile/{filename}', name: 'app_displayFile')]
    public function displayFile(string $filename)
    {
        $path = './users/'.explode('.',$this->getUser()->getUsername())[0].'/';

        $file = new File($path.$filename);

        return $this->file($file, 'tmp', ResponseHeaderBag::DISPOSITION_INLINE);
    }
    #[Route('/deleteFile/{filename}', name: 'app_deleteFile')]
    public function deleteFile(string $filename, Filesystem $filesystem)
    {
        $path = './users/'.explode('.',$this->getUser()->getUsername())[0].'/';

        $status = $filesystem->exists($path.$filename);

        if($status){
            $file = new File($path.$filename);
            $filesystem->remove($file);
        }

        return $this->forward('App\Controller\FilesController::index');
    }

    #[Route('/uploadFile', name: 'app_uploadFile')]
    public function uploadFile()
    {
        return $this->render('files/upload.html.twig',[]);
    }

}
