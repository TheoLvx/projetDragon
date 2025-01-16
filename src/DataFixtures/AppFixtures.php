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
use App\Entity\Niveau;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $niveau1 = new Niveau();
        $niveau1->setNom('Introduction');
        $niveau1->setDescription('Les dragons sont des espèces rare qui ne sont pas très amicaux avec les humains... Brûler les villages, c\' ce n\'est pas vraiment quelque chose que les villageois aiment, ducoup faut les chasser aller va chercher l\'oeuf');
        $niveau1->setImage('vide');
        $manager->persist($niveau1);

        $niveau2 = new Niveau();
        $niveau2->setNom('APRES LE PERIPLE');
        $niveau2->setDescription('Je ne sais pas c\'est quoi la suite mais ca fait office de test... que faire ???');
        $niveau2->setImage('vide');
        $manager->persist($niveau2);

// LISTE SCENARIOS

        $scenario1 = new Scenario();
        $scenario1->setNom('Passer par la forêt');
        $scenario1->setContexte('Provoquer dame nature');
        $scenario1->setLeNiveau($niveau1);
        $scenario1->setImage("vide");

        $scenario2 = new Scenario();
        $scenario2->setNom('Passer par le village');
        $scenario2->setContexte('Rencontrer ses habitants...');
        $scenario2->setLeNiveau($niveau1);
        $scenario2->setImage("vide");

        $scenario3 = new Scenario();
        $scenario3->setNom('Appeler la police');
        $scenario3->setContexte('Provoquer dame nature');
        $scenario3->setLeNiveau($niveau2);
        $scenario3->setImage("vide");

        $scenario4 = new Scenario();
        $scenario4->setNom('Prendre le balai magique');
        $scenario4->setContexte('Rencontrer ses habitants...');
        $scenario4->setLeNiveau($niveau2);
        $scenario4->setImage("vide");
        
// SCENARIO 1 CHOIX

        $choix1 = new Choix();
        $choix1->setTexte('EXPLOSION');
        $choix1->setExplications("CA A EXPLOSé");
        $choix1->setLeScenario($scenario2);
        $choix1->setHp(2);
        $choix1->setIntelligence(1);
        $choix1->setAttaque(1);
        $manager->persist($choix1);

        $choix2 = new Choix();
        $choix2->setTexte('Sorcier');
        $choix2->setExplications("Il te donne beaucoup d'hp");
        $choix2->setLeScenario($scenario2);
        $choix2->setHp(1);
        $choix2->setIntelligence(2);
        $choix2->setAttaque(2);
        $manager->persist($choix2);

// SCENARIO 2

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

// SCENARIO 3

        $choix5 = new Choix();
        $choix5->setTexte('MENOOOTTTEEEESS');
        $choix5->setExplications("Vous vous êtes fait arrêté");
        $choix5->setLeScenario($scenario3);
        $choix5->setHp(2);
        $choix5->setIntelligence(1);
        $choix5->setAttaque(1);
        $manager->persist($choix5);

        $choix6 = new Choix();
        $choix6->setTexte('Pot de vin');
        $choix6->setExplications("Vous avez réussi a soudoyer un policier");
        $choix6->setLeScenario($scenario3);
        $choix6->setHp(1);
        $choix6->setIntelligence(2);
        $choix6->setAttaque(2);
        $manager->persist($choix6);

// SCENARIO 4

        $choix7 = new Choix();
        $choix7->setTexte('HARRY POTTER vous a défoncer la gueule');
        $choix7->setExplications("C'est dommage");
        $choix7->setLeScenario($scenario4);
        $choix7->setHp(2);
        $choix7->setIntelligence(1);
        $choix7->setAttaque(1);
        $manager->persist($choix7);

        $choix8 = new Choix();
        $choix8->setTexte('Vous vous envolez vers l\'espace');
        $choix8->setExplications("Le vent souffle ");
        $choix8->setLeScenario($scenario4);
        $choix8->setHp(1);
        $choix8->setIntelligence(2);
        $choix8->setAttaque(2);
        $manager->persist($choix8);


        $scenario1->setLesChoix([$choix1, $choix2]);
        $scenario2->setLesChoix([$choix3, $choix4]);
        $scenario3->setLesChoix([$choix5, $choix6]);
        $scenario4->setLesChoix([$choix7, $choix8]);
        $manager->persist($scenario1);
        $manager->persist($scenario2);
        $manager->persist($scenario3);
        $manager->persist($scenario4);

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
