<?php

namespace App\Controller;

use App\Entity\Conducteur;
use App\Form\Conducteur1Type;
use App\Repository\ConducteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/conducteur")
 */
class AdminConducteurController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_conducteur_index", methods={"GET"})
     */
    public function index(ConducteurRepository $conducteurRepository): Response
    {
        return $this->render('admin_conducteur/index.html.twig', [
            'conducteurs' => $conducteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_conducteur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ConducteurRepository $conducteurRepository): Response
    {
        $conducteur = new Conducteur();
        $form = $this->createForm(Conducteur1Type::class, $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conducteurRepository->add($conducteur, true);

            return $this->redirectToRoute('app_admin_conducteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_conducteur/new.html.twig', [
            'conducteur' => $conducteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_conducteur_show", methods={"GET"})
     */
    public function show(Conducteur $conducteur): Response
    {
        return $this->render('admin_conducteur/show.html.twig', [
            'conducteur' => $conducteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_conducteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Conducteur $conducteur, ConducteurRepository $conducteurRepository): Response
    {
        $form = $this->createForm(Conducteur1Type::class, $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conducteurRepository->add($conducteur, true);

            return $this->redirectToRoute('app_admin_conducteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_conducteur/edit.html.twig', [
            'conducteur' => $conducteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_conducteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Conducteur $conducteur, ConducteurRepository $conducteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conducteur->getId(), $request->request->get('_token'))) {
            $conducteurRepository->remove($conducteur, true);
        }

        return $this->redirectToRoute('app_admin_conducteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
