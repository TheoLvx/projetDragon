<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Scenario;
use App\Entity\Choix;
use App\Entity\Perso;
use App\Entity\User;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $scenario1 = new Scenario();
        $scenario1->setNom('Passer par la forêt');
        $scenario1->setContexte('Provoquer dame nature');
        $scenario1->setNiveau(1);
        $scenario1->setImage("vide");

        $scenario2 = new Scenario();
        $scenario2->setNom('Passer par le village');
        $scenario2->setContexte('Rencontrer ses habitants...');
        $scenario2->setNiveau(1);
        $scenario2->setImage("vide");
        

        $choix1 = new Choix();
        $choix1->setTexte('EXPLOSION');
        $choix1->setExplications("CA A EXPLOSé");
        $choix1->setLeScenario($scenario1);
        $choix1->setHp(2);
        $choix1->setIntelligence(1);
        $choix1->setAttaque(1);
        $manager->persist($choix1);

        $choix2 = new Choix();
        $choix2->setTexte('Sorcier');
        $choix2->setExplications("Il te donne beaucoup d'hp");
        $choix2->setLeScenario($scenario1);
        $choix2->setHp(1);
        $choix2->setIntelligence(2);
        $choix2->setAttaque(2);
        $manager->persist($choix2);

        $choix3 = new Choix();
        $choix3->setTexte('JE SAIS PAS MAIS ATTENTION');
        $choix3->setExplications("C'est dommage");
        $choix3->setLeScenario($scenario1);
        $choix3->setHp(2);
        $choix3->setIntelligence(1);
        $choix3->setAttaque(1);
        $manager->persist($choix3);

        $choix4 = new Choix();
        $choix4->setTexte('Loup');
        $choix4->setExplications("Attaque de loup");
        $choix4->setLeScenario($scenario1);
        $choix4->setHp(1);
        $choix4->setIntelligence(2);
        $choix4->setAttaque(2);
        $manager->persist($choix4);

        $scenario1->setLesChoix([$choix1, $choix2]);
        $scenario2->setLesChoix([$choix3, $choix4]);
        $manager->persist($scenario1);
        $manager->persist($scenario2);

        $perso = new Perso();
        $perso->setUsername('dragonSlayer');
        $perso->setHp(10);
        $perso->setIntelligence(5);
        $perso->setAttaque(5);
        $manager->persist($perso);

        $user = new User();
        $user->setUsername('admin2');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'admin123' 
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
