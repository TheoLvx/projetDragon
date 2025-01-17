<?php

namespace App\Controller;

use App\Entity\Choix;
use App\Entity\Niveau;

use App\Entity\Scenario;
use App\Form\ScenarioType;
use App\Repository\PersoRepository;
use App\Repository\NiveauRepository;
use App\Repository\ScenarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


#[Route('/scenario')]
final class ScenarioController extends AbstractController
{
    #[Route('/admin', name: 'app_scenario_index', methods: ['GET'])]
    public function index(ScenarioRepository $scenarioRepository): Response
    {
        return $this->render('scenario/index.html.twig', [
            'scenarios' => $scenarioRepository->findAll(),
        ]);
    }

    #[Route('/niveau/{niveau}', name: 'app_scenario_niveau', methods: ['GET'])]
public function byLevel(
    ScenarioRepository $scenarioRepository,
    Niveau $niveau,
    PersoRepository $persoRepository,
    SessionInterface $session
): Response {
    // Récupérer l'ID du personnage depuis la session
    $persoId = $session->get('perso_id');

    if (!$persoId) {
        throw $this->createNotFoundException('Aucun personnage trouvé dans la session.');
    }

    // Charger l'objet Perso à partir de l'ID
    $perso = $persoRepository->find($persoId);

    if (!$perso) {
        throw $this->createNotFoundException('Personnage non trouvé en base de données.');
    }

    // Récupérer les scénarios associés au niveau
    $scenarios = $scenarioRepository->findBy(['LeNiveau' => $niveau]);

    return $this->render('scenario/niveau.html.twig', [
        'niveau' => $niveau,
        'scenarios' => $scenarios,
        'perso' => $perso,
    ]);
}


    #[Route('/{id}/result', name: 'app_choix_result', methods: ['GET'])]
    public function randomChoix(Scenario $scenario, EntityManagerInterface $entityManager, NiveauRepository $niveauRepository, PersoRepository $persoRepository): Response
    {
        $choix = $entityManager->getRepository(Choix::class)->findBy(['LeScenario' => $scenario]);
    
        if (empty($choix)) {
            $this->addFlash('warning', 'Aucun choix disponible pour ce scénario.');
            return $this->redirectToRoute('app_scenario_show', ['id' => $scenario->getId()]);
        }
    
        $niveau = $scenario->getLeNiveau();
        $nextLevel = $niveauRepository->findOneBy(['numero' => $niveau->getNumero() + 1]);
        $randomchoix = $choix[array_rand($choix)];
        $perso = $persoRepository->findOneBy([]);
        $isGameOver = false;
    
        if ($perso) {
            $newHp = $perso->getHp() - $randomchoix->getAttaque();
            $perso->setHp($newHp);
    
            if ($newHp > 0) {
                $newIntelligence = $perso->getIntelligence() + $randomchoix->getIntelligence();
                $newAttaque = $perso->getAttaque() + $randomchoix->getAttaque();
    
                $perso->setIntelligence($newIntelligence);
                $perso->setAttaque($newAttaque);
            }
    
            if ($newHp <= 0) {
                $isGameOver = true;
            }
    
            $entityManager->flush();
        }
    
        return $this->render('choix/result.html.twig', [
            'scenario' => $scenario,
            'choix' => $randomchoix,
            'nextLevel' => $nextLevel,
            'isGameOver' => $isGameOver,
        ]);
    }
    
    #[Route('/new', name: 'app_scenario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $scenario = new Scenario();
        $form = $this->createForm(ScenarioType::class, $scenario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($scenario);
            $entityManager->flush();

            return $this->redirectToRoute('app_scenario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('scenario/new.html.twig', [
            'scenario' => $scenario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_scenario_show', methods: ['GET'])]
    public function show(Scenario $scenario): Response
    {
        return $this->render('scenario/show.html.twig', [
            'scenario' => $scenario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_scenario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Scenario $scenario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ScenarioType::class, $scenario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_scenario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('scenario/edit.html.twig', [
            'scenario' => $scenario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_scenario_delete', methods: ['POST'])]
    public function delete(Request $request, Scenario $scenario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scenario->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($scenario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_scenario_index', [], Response::HTTP_SEE_OTHER);
    }


}
