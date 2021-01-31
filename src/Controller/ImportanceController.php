<?php

namespace App\Controller;

use App\Entity\Importance;
use App\Form\ImportanceType;
use App\Repository\ImportanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/importance")
 */
class ImportanceController extends AbstractController
{
    /**
     * @Route("/", name="importance_index", methods={"GET"})
     */
    public function index(ImportanceRepository $importanceRepository): Response
    {
        return $this->render('importance/index.html.twig', [
            'importances' => $importanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="importance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $importance = new Importance();
        $form = $this->createForm(ImportanceType::class, $importance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($importance);
            $entityManager->flush();

            return $this->redirectToRoute('importance_index');
        }

        return $this->render('importance/new.html.twig', [
            'importance' => $importance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="importance_show", methods={"GET"})
     */
    public function show(Importance $importance): Response
    {
        return $this->render('importance/show.html.twig', [
            'importance' => $importance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="importance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Importance $importance): Response
    {
        $form = $this->createForm(ImportanceType::class, $importance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('importance_index');
        }

        return $this->render('importance/edit.html.twig', [
            'importance' => $importance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="importance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Importance $importance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$importance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($importance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('importance_index');
    }
}
