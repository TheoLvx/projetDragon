<?php

namespace App\Controller;

use App\Entity\Perso;
use App\Form\PersoType;
use App\Repository\PersoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/perso')]
final class PersoController extends AbstractController
{
    #[Route(name: 'app_perso_index', methods: ['GET'])]
    public function index(PersoRepository $persoRepository): Response
    {
        return $this->render('perso/index.html.twig', [
            'persos' => $persoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_perso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $perso = new Perso();
        $form = $this->createForm(PersoType::class, $perso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($perso);
            $entityManager->flush();

            return $this->redirectToRoute('app_perso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('perso/new.html.twig', [
            'perso' => $perso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perso_show', methods: ['GET'])]
    public function show(Perso $perso): Response
    {
        return $this->render('perso/show.html.twig', [
            'perso' => $perso,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_perso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Perso $perso, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PersoType::class, $perso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_perso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('perso/edit.html.twig', [
            'perso' => $perso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_perso_delete', methods: ['POST'])]
    public function delete(Request $request, Perso $perso, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perso->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($perso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_perso_index', [], Response::HTTP_SEE_OTHER);
    }
}
