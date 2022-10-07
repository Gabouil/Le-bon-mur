<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'Profile',
        ]);
    }
//
//    #[Route('/utilisateur/{id}', name: "app_update_user_role")]
//    public function updateAdminRole($id, UtilisateurRepository $utilisateurRepository): Response
//    {
//        $utilisateur = $utilisateurRepository->findOneBy(["id"=>$id]);
//
//
//    }
}
