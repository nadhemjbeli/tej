<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/admin/voiture")
 */
class AdminVoitureController extends AbstractController
{

    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack){

        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/", name="app_admin_voiture_index", methods={"GET"})
     */
    public function index(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();
        foreach ($voitures as $voiture) {
            $voiture->setPrixActuel();
        }
        return $this->render('admin_voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    /**
     * @Route("/new", name="app_admin_voiture_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VoitureRepository $voitureRepository, SluggerInterface $slugger): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('voiture_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $code = $voiture->getMarque().' '.uniqid();
                $voiture->setImage($newFilename);
                $voiture->setCode($code);
                $voitureRepository->add($voiture, true);
                $session = $this->requestStack->getSession();
                $session->set('code_voiture', $code);
                return $this->redirectToRoute('app_admin_prix_new', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('admin_voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_voiture_show", methods={"GET"})
     */
    public function show(Voiture $voiture): Response
    {
//        dd(uniqid());
        return $this->render('admin_voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_voiture_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Voiture $voiture, VoitureRepository $voitureRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
               $voitureRepository->add($voiture, true);
            $file = $form->get('image')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('voiture_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $voiture->setImage($newFilename);
                $voitureRepository->add($voiture, true);

                return $this->redirectToRoute('app_admin_voiture_index', [], Response::HTTP_SEE_OTHER);
            }
            return $this->redirectToRoute('app_admin_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_voiture_delete", methods={"POST"})
     */
    public function delete(Request $request, Voiture $voiture, VoitureRepository $voitureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $voitureRepository->remove($voiture, true);
        }

        return $this->redirectToRoute('app_admin_voiture_index', [], Response::HTTP_SEE_OTHER);
    }
}
