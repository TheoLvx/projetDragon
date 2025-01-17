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

// Tous les niveaux

        $niveau1 = new Niveau();
        $niveau1->setNom('Introduction');
        $niveau1->setDescription('Bienvenue jeune chasseur de dragon super méga hyper puissant, SACHE que les dragons sont méchant et qu\'ils veulent tout brûler, ET BEAUCOUP DE GENS ont déjà brûlé et toute ta famille également tu es donc ORPHELIN mais c\'est pas pour faire la victime. \n TU as donc décider d\' anéantir les dragons, et pour ne pas proliférer leur espèce, il faut trouver les oeufs avant qu\'ils n\'éclorent... tu sais la suite...' );
        $niveau1->setImage('vide');
        $niveau1->setNumero(1);
        $manager->persist($niveau1);

        $niveau2 = new Niveau();
        $niveau2->setNom('Le petit poucet');
        $niveau2->setDescription('Vous êtes devant un grand champs, l\'idée est la suivante : trouver des traces du passage du dragon... Comment faire...');
        $niveau2->setImage('vide');
        $niveau2->setNumero(2);
        $manager->persist($niveau2);

        $niveau3 = new Niveau();
        $niveau3->setNom('Devant la grande montagne');
        $niveau3->setDescription('Deux possibilités pour monter tout là haut... J\'entends déjà le dragon chier d\'ici');
        $niveau3->setImage('vide');
        $niveau3->setNumero(3);
        $manager->persist($niveau3);

        $niveau4 = new Niveau();
        $niveau4->setNom('Face to face avec le grand dragon de la mort qui tue ???');
        $niveau4->setDescription('IL VA FALLOIR ENGAGER LE COMBAT, QUE FAIRE ???');
        $niveau4->setImage('vide');
        $niveau4->setNumero(4);
        $manager->persist($niveau4);

        $niveau5 = new Niveau();
        $niveau5->setNom('LES OEUFS !!');
        $niveau5->setDescription('VOUS AVEZ REUSSI !!! Bravo, vous pouvez cuisiner ces oeufs ( un max de protéines ) afin que les dragons ne prolifèrent pas... Mais ce ne sont pas les seuls oeufs...');
        $niveau5->setImage('vide');
        $niveau5->setNumero(5);
        $manager->persist($niveau5);


// LISTE SCENARIOS

// Niveau 1 - Intro

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

// Niveau 2 - Le petit poucet

        $scenario3 = new Scenario();
        $scenario3->setNom('Renifler le sol');
        $scenario3->setContexte('Faire le dogo');
        $scenario3->setLeNiveau($niveau2);
        $scenario3->setImage("vide");

        $scenario4 = new Scenario();
        $scenario4->setNom('Prendre le balai magique');
        $scenario4->setContexte('Il y en a un par terre pose pas de questions tu n\' auras pas de réponses.');
        $scenario4->setLeNiveau($niveau2);
        $scenario4->setImage("vide");

// Niveau 3 - Devant la grande montagne

        $scenario5 = new Scenario();
        $scenario5->setNom('Prendre l\'ascenseur');
        $scenario5->setContexte('Quoi vous avez jamais vu un ascenseur sur une montagne ?!');
        $scenario5->setLeNiveau($niveau3);
        $scenario5->setImage("vide");

        $scenario6 = new Scenario();
        $scenario6->setNom('Appeler un sherpa pour qu\'il nous porte en haut');
        $scenario6->setContexte('07 67 27 03 54');
        $scenario6->setLeNiveau($niveau3);
        $scenario6->setImage("vide");

        $scenario7 = new Scenario();
        $scenario7->setNom('Emprunter le chemin super long et chiant mais au moins ça fait les jambes :D');
        $scenario7->setContexte('');
        $scenario7->setLeNiveau($niveau3);
        $scenario7->setImage("vide");

// Niveau 4 - Face to face avec le dragon

        $scenario8 = new Scenario();
        $scenario8->setNom('Coup de coude circulaire dans la molaire');
        $scenario8->setContexte('Bite boxing');
        $scenario8->setLeNiveau($niveau4);
        $scenario8->setImage("vide");

        $scenario9 = new Scenario();
        $scenario9->setNom('Mitraillette dans la tête');
        $scenario9->setContexte('Grosse rafalle en vue ???');
        $scenario9->setLeNiveau($niveau4);
        $scenario9->setImage("vide");

        $scenario10 = new Scenario();
        $scenario10->setNom('Prendre la fuite...');
        $scenario10->setContexte('Loser.');
        $scenario10->setLeNiveau($niveau4);
        $scenario10->setImage("vide");

// Niveau 5

// FIN DONC PAS DE SCENARIOS INCLU


// CHOIX
//  NIVEAU 1


// SCENARIO 1 Passer par la foret 

        $choix1 = new Choix();
        $choix1->setTexte("Koba LaD vous interpelle !");
        $choix1->setExplications("Il vous propose un duel, une enigme à résoudre... Vous gagnez, évidemment. +1 d'intelligence");
        $choix1->setLeScenario($scenario1);
        $choix1->setHp(2);
        $choix1->setIntelligence(1);
        $choix1->setAttaque(1);
        $manager->persist($choix1);

        $choix2 = new Choix();
        $choix2->setTexte('Attaque de loup !');
        $choix2->setExplications("Vous vous faites attaqué par des loups ! Par chance, vous êtes meilleur donc german suplex into coup de genoux. BRAVO A VOUS +2 d'attaque");
        $choix2->setLeScenario($scenario1);
        $choix2->setHp(-3);
        $choix2->setIntelligence(0);
        $choix2->setAttaque(2);
        $manager->persist($choix2);

        $scenario1->setLesChoix([$choix1, $choix2]);
        $manager->persist($scenario1);


                
// SCENARIO 2 Passer par le village 

        $choix3 = new Choix();
        $choix3->setTexte('Attaque de clochard !');
        $choix3->setExplications("Vous vous êtes fait attaqué par des clochards parce que vous avez refuser de leur donner des sous... Vous perdez 3hp et 1 d'attaque. ");
        $choix3->setLeScenario($scenario2);
        $choix3->setHp(-3);
        $choix3->setIntelligence(0);
        $choix3->setAttaque(-1);
        $manager->persist($choix3);

        $choix4 = new Choix();
        $choix4->setTexte('Un sorcier vous interpelle !');
        $choix4->setExplications("Super gentil, un super sorcier vous donne un potion pour améliorer votre attaque, vous gagnez 2 d'attaque, à votre santé :D ");
        $choix4->setLeScenario($scenario2);
        $choix4->setHp(0);
        $choix4->setIntelligence(0);
        $choix4->setAttaque(2);
        $manager->persist($choix4);

        $scenario2->setLesChoix([$choix3, $choix4]);
        $manager->persist($scenario2);



// Niveau 2

// SCENARIO 3 Renifler le sol  

        $choix5 = new Choix();
        $choix5->setTexte('Vous reniflez une odeur !!');
        $choix5->setExplications("Ca sent mauvais le dragon par ici, vous pouvez sentir ses gros panards, alors ya plus qu'à ! +1 d'intelligence parce que trop fort.");
        $choix5->setLeScenario($scenario3);
        $choix5->setHp(0);
        $choix5->setIntelligence(1);
        $choix5->setAttaque(0);
        $manager->persist($choix5);

        $choix6 = new Choix();
        $choix6->setTexte('Une taupe sauvage apparait !! ');
        $choix6->setExplications("Oh non ! Une taupe sauvage, elle est énervée, vous la déranger, gros coup de crâne dans vos morts, -6 hp");
        $choix6->setLeScenario($scenario3);
        $choix6->setHp(-6);
        $choix6->setIntelligence(0);
        $choix6->setAttaque(0);
        $manager->persist($choix6);

        $scenario3->setLesChoix([$choix5, $choix6]);
        $manager->persist($scenario3);



// SCENARIO 4 Prendre le balai magique 

        $choix7 = new Choix();
        $choix7->setTexte('HARRY POTTER DEBARQUE EN T-MAX');
        $choix7->setExplications("Vous lui avez voler son balai magique !! Il vous défonce la gueule, vu qu'il a des lunettes, vous pouvez rien faire... -3hp, il est pas trop stock non plus ça va...");
        $choix7->setLeScenario($scenario4);
        $choix7->setHp(-3);
        $choix7->setIntelligence(0);
        $choix7->setAttaque(-2);
        $manager->persist($choix7);

        $choix8 = new Choix();
        $choix8->setTexte('Vous survolez le champs !');
        $choix8->setExplications("Vous avez une super vue sur les grannnnnnds pas de ce dragon parce qu'il ne vole pas toujours ! Alors suivons les...");
        $choix8->setLeScenario($scenario4);
        $choix8->setHp(1);
        $choix8->setIntelligence(0);
        $choix8->setAttaque(0);
        $manager->persist($choix8);

        $scenario4->setLesChoix([$choix7, $choix8]);
        $manager->persist($scenario4);




// Niveau 3 - Devant la montagne
//  SCENARIO 5 - Prendre l'ascenseur

        $choix9 = new Choix();
        $choix9->setTexte('Vous avez gagner UN MAX de temps, en plus il y avait une super musique qui rentre dans la tête... +2hp -2 d\'intelligence');
        $choix9->setExplications("C'est dommage");
        $choix9->setLeScenario($scenario5);
        $choix9->setHp(+2);
        $choix9->setIntelligence(-2);
        $choix9->setAttaque(0);
        $manager->persist($choix9);

        $choix10 = new Choix();
        $choix10->setTexte('Eh non c\'était un prank, non mais serieux, un ascenseur ... aller monte tout seul');
        $choix10->setExplications("Le vent souffle ");
        $choix10->setLeScenario($scenario5);
        $choix10->setHp(-2);
        $choix10->setIntelligence(0);
        $choix10->setAttaque(0);
        $manager->persist($choix10);
        
        $scenario5->setLesChoix([$choix9, $choix10]);
        $manager->persist($scenario5);



//  SCENARIO 6 - Appeler un sherpa

        $choix11 = new Choix();
        $choix11->setTexte('Il a dit non.');
        $choix11->setExplications("Vous montez la montagne à pied ...");
        $choix11->setLeScenario($scenario6);
        $choix11->setHp(-2);
        $choix11->setIntelligence(0);
        $choix11->setAttaque(-1);
        $manager->persist($choix11);

        $choix12 = new Choix();
        $choix12->setTexte('Vous vous faites porter comme inox vers le sommet');
        $choix12->setExplications("Vers l'infini et par là bas !!!");
        $choix12->setLeScenario($scenario6);
        $choix12->setHp(1);
        $choix12->setIntelligence(2);
        $choix12->setAttaque(2);
        $manager->persist($choix12);

        $scenario6->setLesChoix([$choix11, $choix12]);
        $manager->persist($scenario6);



//  SCENARIO 7 - Chemin long et chiant

        $choix13 = new Choix();
        $choix13->setTexte('Vous êtes épuisé donc -2hp pour la forme d\'avoir voulu monter tout seul comme un grand +2hp, vous perdez rien :D');
        $choix13->setExplications("Vers l'infini et par là bas !!!");
        $choix13->setLeScenario($scenario7);
        $choix13->setHp(0);
        $choix13->setIntelligence(0);
        $choix13->setAttaque(0);
        $manager->persist($choix13);

        $scenario7->setLesChoix([$choix13]);
        $manager->persist($scenario7);



//Niveau 4

//  SCENARIO 8 - Coup de coude 

        $choix14 = new Choix();
        $choix14->setTexte('Oh le coup de coude circulaire du futur INTO CLé DE BRAS  !!');
        $choix14->setExplications("Vous êtes un grand malade, vous avez one shot ce dragon de 6km de long et 10km de large, gg à vous jeune slayer");
        $choix14->setLeScenario($scenario8);
        $choix14->setHp(1000);
        $choix14->setIntelligence(1000);
        $choix14->setAttaque(1000);
        $manager->persist($choix14);

        $choix15 = new Choix();
        $choix15->setTexte('Vous avez louper votre coup critique... ');
        $choix15->setExplications("Vous vous êtes fait mangé tout cru !");
        $choix15->setLeScenario($scenario8);
        $choix15->setHp(-1000);
        $choix15->setIntelligence(0);
        $choix15->setAttaque(0);
        $manager->persist($choix15);

        $scenario8->setLesChoix([$choix14, $choix15]);
        $manager->persist($scenario8);



//  SCENARIO 9 - Mitraillette 

        $choix16 = new Choix();
        $choix16->setTexte('Vous avez jeter la mitraillette sur la tête du dragon.');
        $choix16->setExplications("Vous êtes complètement débile, le dragon, pas content vous a mangé tout cru !");
        $choix16->setLeScenario($scenario9);
        $choix16->setHp(-1000);
        $choix16->setIntelligence(-1000);
        $choix16->setAttaque(-1000);
        $manager->persist($choix16);

        $choix17 = new Choix();
        $choix17->setTexte('Vous n\'avez pas d\'aim ');
        $choix17->setExplications("Vous pouvez toujours installer aimlab et retenter votre chance ! Mais là, vous êtes mauvais... BOUFFé PAR LE DRAGON !");
        $choix17->setLeScenario($scenario9);
        $choix17->setHp(-1000);
        $choix17->setIntelligence(-1000);
        $choix17->setAttaque(-1000);
        $manager->persist($choix17);

        $choix18 = new Choix();
        $choix18->setTexte('Grosse raffalle dans son crâne, vous êtes trop chaud ! ');
        $choix18->setExplications("Mort du dragon imminente ! Ya plus qu'à t-bag le corps !!");
        $choix18->setLeScenario($scenario9);
        $choix18->setHp(+1000);
        $choix18->setIntelligence(0);
        $choix18->setAttaque(+1000);
        $manager->persist($choix18);

        $scenario9->setLesChoix([$choix16, $choix17, $choix18]);
        $manager->persist($scenario9);


//  SCENARIO 10 - Fuite

        $choix19 = new Choix();
        $choix19->setTexte('Vous avez prit la fuite !!!');
        $choix19->setExplications("Caca culotte ou quoi là ? -8000 de charisme");
        $choix19->setLeScenario($scenario10);
        $choix19->setHp(-1000);
        $choix19->setIntelligence(-1000);
        $choix19->setAttaque(-1000);
        $manager->persist($choix19);

        $scenario10->setLesChoix([$choix19]);
        $manager->persist($scenario10);

//Niveau 5

// PAS DE SCENARIO CAR FIN DU JEU  


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