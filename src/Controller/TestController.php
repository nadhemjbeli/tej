<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\ImagesVoituresRepository;
use App\Repository\VoitureRepository;
use DateInterval;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function accueuil(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();
//        $currentDate = new \DateTime();
//        $currentYear = $currentDate->format("Y");
        foreach ($voitures as $voiture){
            $voiture->setPrixActuel();
//            $dS1 = $currentYear."-".$voiture->getPrix()->getDateDebutS1();
//            $dS2 = $currentYear."-".$voiture->getPrix()->getDateDebutS2();
//            $dS3 = $currentYear."-".$voiture->getPrix()->getDateDebutS3();
//            $dS4 = $currentYear."-".$voiture->getPrix()->getDateDebutS4();
//            $dateDS1 = \DateTime::createFromFormat('Y-m-d', $dS1);
//            $dateDS2 = \DateTime::createFromFormat('Y-m-d', $dS2);
//            $dateDS3 = \DateTime::createFromFormat('Y-m-d', $dS3);
//            $dateDS4 = \DateTime::createFromFormat('Y-m-d', $dS4);
////            Todo: dates finales
//            $dateFS1 = \DateTime::createFromFormat('Y-m-d', $dS2);
//            $dateFS1->sub(new DateInterval('P1D'));
//            $dateFS2 = \DateTime::createFromFormat('Y-m-d', $dS3);
//            $dateFS2->sub(new DateInterval('P1D'));
//            $dateFS3 = \DateTime::createFromFormat('Y-m-d', $dS4);
//            $dateFS3->sub(new DateInterval('P1D'));
//            $dateFS4 = \DateTime::createFromFormat('Y-m-d', $dS1);
//            $dateFS4
////                ->add(new DateInterval('P1Y'))
//                ->sub(new DateInterval('P1D'));
//            if ($currentDate > $dateDS1 && $currentDate > $dateFS1){
//                $voiture->setPrixActuel($voiture->getPrix()->getPrixS1());
//            }
//            else if ($currentDate > $dateDS2 && $currentDate < $dateFS2){
//                $voiture->setPrixActuel($voiture->getPrix()->getPrixS2());
//            }
//            else if ($currentDate > $dateDS3 && $currentDate < $dateFS3){
//                $voiture->setPrixActuel($voiture->getPrix()->getPrixS2());
//            }
//            else if ($currentDate > $dateDS4 && $currentDate < $dateFS4){
//                $voiture->setPrixActuel($voiture->getPrix()->getPrixS2());
//            }
//            $dateDS4 = \DateTime::createFromFormat('Y-m-d', $dS4);

////            $dateDS1 = $dS1[0].$dS1[1]
//            dd($voiture->getPrixActuel());

        }
        $categories = [];
        $list_voitures = [];
        /** @var Voiture[] $voituresByCategorie */
        $voituresByCategorie = $voitureRepository->findByCategorie();
//        dd($voituresByCategorie);
        foreach ($voituresByCategorie as $cat){
            $c = $cat->getCategorie();
            array_push($categories, $c);
            array_push($list_voitures, $voitureRepository->findBy(['categorie'=>$c]));
        }
        return $this->render('client_reservation/accueil.html.twig', [
            'controller_name' => 'TestController',
            'categories' => $categories,
            'list_voitures' => $list_voitures,
            'tout_voitures' => $voitures,
        ]);
    }
    /**
     * @Route("/points-forts", name="app_points_forts")
     */
    public function pointsForts(){
        return $this->render('test/points_fort.html.twig', [

        ]);
    }

    function getVoiturePrixActuel(Voiture $voitures){

//        foreach ($voitures as $voiture){
//            $date = $voiture->
//        }
    }

    /**
     * @Route("/{id}/images", name="app_images")
     */
    public function imagesMultiple(ImagesVoituresRepository $imagesVoituresRepository, Voiture $voiture): Response
    {

        $imagesVoitures = $imagesVoituresRepository->findBy(['voiture' => $voiture]);
//        dd($imagesVoitures);

        return $this->render('client_reservation/reserve/test.html.twig', [
            'images_voitures' => $imagesVoitures
        ]);
    }
    /**
     * @Route("/test", name="app_test")
     */
    public function test(ImagesVoituresRepository $imagesVoituresRepository ): Response
    {

//        $imagesVoitures = $imagesVoituresRepository->findBy(['voiture' => $voiture]);
//        dd($imagesVoitures);

        return $this->render('base_back.html.twig', [
//            'images_voitures' => $imagesVoitures
        ]);
    }
}
