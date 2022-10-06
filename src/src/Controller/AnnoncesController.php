<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{
    #[Route('/annonces', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('annonces/index.html.twig', [
            'controller_name' => 'AnnoncesController',
        ]);
    }

    #[Route('/annonces/{id}', name: 'app_annonces_by_id')]
    public function getAnnonceById($id): Response
    {
        return $this->render('annoncesById/index.html.twig', [
            'page_name' => "Annonce n°$id",
        ]);
    }
}
