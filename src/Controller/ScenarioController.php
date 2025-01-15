<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ScenarioController extends AbstractController
{
    #[Route('/scenario', name: 'app_scenario')]
    public function index(): Response
    {
        return $this->render('scenario/index.html.twig', [
            'controller_name' => 'ScenarioController',
        ]);
    }
}
