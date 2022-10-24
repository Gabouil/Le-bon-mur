<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnoncesController extends AbstractController
{
    /**
     * @param AnnonceRepository $annonceRepository
     * @return Response
     */
    #[Route('/annonces', name: 'app_index')]
    public function index(AnnonceRepository $annonceRepository): Response
    {
        $annonces = $annonceRepository->findAllPublished();

        return $this->render('annonces/index.html.twig', [
            'controller_name' => 'AnnoncesController',
            'annonces' => $annonces
        ]);
    }


    /**
     * @return Response
     */
    #[Route('/annonces/add', name: 'app_add_annonce')]
    public function addAnnonce(): Response
    {
        return $this->render('annonces/addAnnonces.html.twig');
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/annonces/handle_form', name: 'app_add_annonce_form', methods: ['POST'])]
    public function annonceFormHandler(Request $request, EntityManagerInterface $entityManager): Response
    {
        dump($request);
        $newAnnonce = (new Annonce())
            ->setTitle($request->request->get('title'))
            ->setDescription($request->request->get("desc"))
            ->setPrice($request->request->get("price"))
            ->setPhotos(["https://www.fidealis.com/wp-content/uploads/2019/09/copyright-filigrane-photo-1024x576.jpg", "https://img.20mn.fr/hwEpbL-5RHOpinEURr3ItA/768x492_debuter-appareil-pro-aidera-forcement", "https://www.petitescargot-photos.com/wp-content/uploads/2020/11/Photographie.jpg"])
            ->setAuthor()
            ->setCreatedAt(new \DateTime());

        $entityManager->persist($newAnnonce);
        $entityManager->flush();

        return $this->redirectToRoute("app_index");
    }


    /**
     * @param $id
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    #[Route('/annonces/delete/{id}', name: "app_annonce_delete", methods: ["DELETE"])]
    public function deleteAnnonce($id, EntityManagerInterface $entityManager): Response
    {
        $annonce = $entityManager->getReference(Annonce::class, $id);

        $entityManager->remove($annonce);
        $entityManager->flush();

        return $this->redirectToRoute("app_index");
    }

    /**
     * @param $id
     * @param AnnonceRepository $annonceRepository
     * @return Response
     */
    #[Route('/annonces/{id}', name: 'app_annonces_by_id')]
    public function getAnnonceById($id, AnnonceRepository $annonceRepository): Response
    {
        $annonce = $annonceRepository->findPublishedByid($id);
        return $this->render('annonces/annonceById.html.twig', [
            'page_name' => "Annonce n°$id",
            'annonce' => $annonce
        ]);
    }
}
