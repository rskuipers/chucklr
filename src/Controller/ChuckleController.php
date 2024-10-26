<?php

namespace App\Controller;

use App\Entity\Chuckle;
use App\Form\ChuckleType;
use App\Repository\ChuckleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/chuckle')]
final class ChuckleController extends AbstractController
{
    #[Route(name: 'app_chuckle_index', methods: ['GET'])]
    public function index(ChuckleRepository $chuckleRepository): Response
    {
        $form = $this->createForm(ChuckleType::class);

        return $this->render('chuckle/index.html.twig', [
            'chuckles' => $chuckleRepository->getTimeline(),
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_chuckle_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chuckle = new Chuckle($this->getUser());
        $form = $this->createForm(ChuckleType::class, $chuckle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chuckle);
            $entityManager->flush();

            return $this->redirectToRoute('app_chuckle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chuckle/new.html.twig', [
            'chuckle' => $chuckle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chuckle_show', methods: ['GET'])]
    public function show(Chuckle $chuckle): Response
    {
        return $this->render('chuckle/show.html.twig', [
            'chuckle' => $chuckle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chuckle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chuckle $chuckle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChuckleType::class, $chuckle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_chuckle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chuckle/edit.html.twig', [
            'chuckle' => $chuckle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chuckle_delete', methods: ['POST'])]
    public function delete(Request $request, Chuckle $chuckle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chuckle->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($chuckle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_chuckle_index', [], Response::HTTP_SEE_OTHER);
    }
}
