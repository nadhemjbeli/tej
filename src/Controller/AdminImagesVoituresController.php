<?php

namespace App\Controller;

use App\Entity\ImagesVoitures;
use App\Form\ImagesVoituresType;
use App\Repository\ImagesVoituresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/admin/images/voitures")
 */
class AdminImagesVoituresController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_images_voitures_index", methods={"GET"})
     */
    public function index(ImagesVoituresRepository $imagesVoituresRepository): Response
    {
        return $this->render('admin_images_voitures/index.html.twig', [
            'images_voitures' => $imagesVoituresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_images_voitures_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ImagesVoituresRepository $imagesVoituresRepository, SluggerInterface $slugger): Response
    {
        $imagesVoiture = new ImagesVoitures();
        $form = $this->createForm(ImagesVoituresType::class, $imagesVoiture);
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
                        $this->getParameter('voiture_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $imagesVoiture->setImage($newFilename);
                $imagesVoituresRepository->add($imagesVoiture, true);

                return $this->redirectToRoute('app_admin_images_voitures_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('admin_images_voitures/new.html.twig', [
            'images_voiture' => $imagesVoiture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_images_voitures_show", methods={"GET"})
     */
    public function show(ImagesVoitures $imagesVoiture): Response
    {
        return $this->render('admin_images_voitures/show.html.twig', [
            'images_voiture' => $imagesVoiture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_images_voitures_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ImagesVoitures $imagesVoiture, ImagesVoituresRepository $imagesVoituresRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ImagesVoituresType::class, $imagesVoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
                            $this->getParameter('voiture_images_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $imagesVoiture->setImage($newFilename);
                    $imagesVoituresRepository->add($imagesVoiture, true);

                    return $this->redirectToRoute('app_admin_images_voitures_index', [], Response::HTTP_SEE_OTHER);
                }
            }
        }

        return $this->renderForm('admin_images_voitures/edit.html.twig', [
            'images_voiture' => $imagesVoiture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_images_voitures_delete", methods={"POST"})
     */
    public function delete(Request $request, ImagesVoitures $imagesVoiture, ImagesVoituresRepository $imagesVoituresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imagesVoiture->getId(), $request->request->get('_token'))) {
            $imagesVoituresRepository->remove($imagesVoiture, true);
        }

        return $this->redirectToRoute('app_admin_images_voitures_index', [], Response::HTTP_SEE_OTHER);
    }
}
