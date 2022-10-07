<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Utilisateur;
use App\Factory\AnnonceFactory;
use App\Factory\UtilisateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        UtilisateurFactory::createMany(10);
        AnnonceFactory::createMany(50, function () {
            return ['author' => UtilisateurFactory::random()];
        });

//        $newUser1 = (new Utilisateur())
//            ->setName("admin")
//            ->setPassword("1234")
//            ->setEmail("admin@lebonmur.fr")
//            ->setIsAdmin(1);
//        $newUser2 = (new Utilisateur())
//            ->setName("Michel")
//            ->setPassword("1234")
//            ->setEmail("michel@gmail.com")
//            ->setIsAdmin(0);
//
//        $manager->persist($newUser1);
//        $manager->persist($newUser2);
//        $manager->flush();
    }
}
