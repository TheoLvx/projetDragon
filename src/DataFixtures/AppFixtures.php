<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Scenario;
use App\Entity\Choix;
use App\Entity\Perso;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $scenario1 = new Scenario();
        $scenario1->setNom('Scenario 1');
        $scenario1->setContexte('Description du scenario 1');
        $scenario1->setNiveau(1);
        $scenario1->setImage("vide");
        

        $choix1 = new Choix();
        $choix1->setTexte('Choix 1');
        $choix1->setExplications("Explications du choix 1");
        $choix1->setLeScenario($scenario1);
        $choix1->setHp(2);
        $choix1->setIntelligence(1);
        $choix1->setAttaque(1);
        $manager->persist($choix1);

        $choix2 = new Choix();
        $choix2->setTexte('Choix 2');
        $choix2->setExplications("Explications du choix 2");
        $choix2->setLeScenario($scenario1);
        $choix2->setHp(1);
        $choix2->setIntelligence(2);
        $choix2->setAttaque(2);
        $manager->persist($choix2);

        $scenario1->setLesChoix([$choix1, $choix2]);
        $manager->persist($scenario1);

        $perso = new Perso();
        $perso->setUsername('dragonSlayer');
        $perso->setHp(10);
        $perso->setIntelligence(5);
        $perso->setAttaque(5);
        $manager->persist($perso);

        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('$2y$13$1Q6');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);


        $manager->flush();
    }
}
