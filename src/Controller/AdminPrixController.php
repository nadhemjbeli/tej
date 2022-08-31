<?php

namespace App\Controller;

use App\Entity\Prix;
use App\Form\PrixType;
use App\Repository\PrixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/prix")
 */
class AdminPrixController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_prix_index", methods={"GET"})
     */
    public function index(PrixRepository $prixRepository): Response
    {
        return $this->render('admin_prix/index.html.twig', [
            'prixes' => $prixRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_prix_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PrixRepository $prixRepository): Response
    {
        $prix = new Prix();
        $form = $this->createForm(PrixType::class, $prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prixRepository->add($prix, true);

            return $this->redirectToRoute('app_admin_prix_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prix/new.html.twig', [
            'prix' => $prix,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_prix_show", methods={"GET"})
     */
    public function show(Prix $prix): Response
    {
        return $this->render('admin_prix/show.html.twig', [
            'prix' => $prix,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_prix_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Prix $prix, PrixRepository $prixRepository): Response
    {
        $form = $this->createForm(PrixType::class, $prix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prixRepository->add($prix, true);

            return $this->redirectToRoute('app_admin_prix_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_prix/edit.html.twig', [
            'prix' => $prix,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_prix_delete", methods={"POST"})
     */
    public function delete(Request $request, Prix $prix, PrixRepository $prixRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prix->getId(), $request->request->get('_token'))) {
            $prixRepository->remove($prix, true);
        }

        return $this->redirectToRoute('app_admin_prix_index', [], Response::HTTP_SEE_OTHER);
    }
}
