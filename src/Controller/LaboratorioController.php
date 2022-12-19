<?php

namespace App\Controller;

use App\Entity\Laboratorio;
use App\Form\LaboratorioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/laboratorio')]
class LaboratorioController extends AbstractController
{
    #[Route('/', name: 'app_laboratorio_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $laboratorios = $entityManager
            ->getRepository(Laboratorio::class)
            ->findAll();

        return $this->render('laboratorio/index.html.twig', [
            'laboratorios' => $laboratorios,
        ]);
    }

    #[Route('/new', name: 'app_laboratorio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $laboratorio = new Laboratorio();
        $form = $this->createForm(LaboratorioType::class, $laboratorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($laboratorio);
            $entityManager->flush();

            return $this->redirectToRoute('app_laboratorio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('laboratorio/new.html.twig', [
            'laboratorio' => $laboratorio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_laboratorio_show', methods: ['GET'])]
    public function show(Laboratorio $laboratorio): Response
    {
        return $this->render('laboratorio/show.html.twig', [
            'laboratorio' => $laboratorio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_laboratorio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Laboratorio $laboratorio, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LaboratorioType::class, $laboratorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_laboratorio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('laboratorio/edit.html.twig', [
            'laboratorio' => $laboratorio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_laboratorio_delete', methods: ['POST'])]
    public function delete(Request $request, Laboratorio $laboratorio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$laboratorio->getId(), $request->request->get('_token'))) {
            $entityManager->remove($laboratorio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_laboratorio_index', [], Response::HTTP_SEE_OTHER);
    }
}
