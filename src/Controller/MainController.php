<?php

namespace App\Controller;

use App\Form\FileFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_upload")
     */
    public function upload(Request $request, SluggerInterface $slugger)
    {
        $form = $this->createForm(FileFormType::class);
        return $this->render('main/main.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/display", name="main_display_content")
     */
    public function displayContent(Request $request, SluggerInterface $slugger)
    {
        $form = $this->createForm(FileFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFileName);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
            echo file_get_contents($file);
        }
        return $this->render('main/display.html.twig');
    }
}
