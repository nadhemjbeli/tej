<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
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
//        dd($list_voitures);
        return $this->render('client_reservation/accueil.html.twig', [
            'controller_name' => 'TestController',
            'categories' => $categories,
            'list_voitures' => $list_voitures,
            'tout_voitures' => $voitureRepository->findAll(),
        ]);
    }
    /**
     * @Route("/points-forts", name="app_points_forts")
     */
    function pointsForts(){
        return $this->render('test/points_fort.html.twig', [

        ]);
    }
}
