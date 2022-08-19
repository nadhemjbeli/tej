<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Repository\ReservationRepository;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//
/**
 * @Route("/client/reservation")
 */
class ClientReservationController extends AbstractController
{
    /**
     * @Route("/", name="app_client_voiture")
     */
    public function voiturePage(ReservationRepository $reservationRepository, VoitureRepository $voitureRepository, Request $request): Response
    {
        $carburants = [];
        $categories = [];
        $voitures = $voitureRepository->findAll();
        /** @var Voiture[] $voituresByCarburant */
        $voituresByCarburant = $voitureRepository->findByCarburant();

        foreach ($voituresByCarburant as $voiture){
            array_push($carburants, $voiture->getCarburant());
        }

        /** @var Voiture[] $voituresByCategorie */
        $voituresByCategorie = $voitureRepository->findByCategorie();
//        dd($voituresByCategorie);
        foreach ($voituresByCategorie as $cat){
            array_push($categories, $cat->getCategorie());
        }

        if ($request->getMethod() == Request::METHOD_POST){
            $search_transmission = $request->request->get("_transmission");
            if($search_transmission == null){
                $search_transmission = "";
            }
            $search_categorie = $request->request->get("_categorie");
            if($search_categorie == null){
                $search_categorie = "";
            }
            $search_carburant = $request->request->get("_carburant");
            if($search_carburant == null){
                $search_carburant = "";
            }
            $voitures = $voitureRepository->searchVoture($search_transmission, $search_categorie, $search_carburant);

        }

//        $reservations = $reservationRepository->findAll();
        return $this->render('client_reservation/list_voitures.html.twig', [
//            'reservations' => $reservations,
            'carburants' => $carburants,
            'categories' => $categories,
            'voitures' => $voitures
        ]);
    }
}
