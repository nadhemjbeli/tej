<?php

namespace App\Controller;

use App\Entity\Conducteur;
use App\Entity\Reservation;
use App\Entity\Voiture;
use App\Form\ConducteurType;
use App\Repository\ConducteurRepository;
use App\Repository\ReservationRepository;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//
/**
 * @Route("/client")
 */
class ClientReservationController extends AbstractController
{

    private $requestStack;

    private $entityManager;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/reservation", name="app_client_voiture")
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

    /**
     * @Route("/reserve", name="app_get_reservation")
     */
    function get_reservation(Request $request, VoitureRepository $voitureRepository){
        $code = uniqid();
        $id = $request->query->get('id');
        $lieu_prise = $request->query->get('lieu_prise');
        $lieu_reprise = $request->query->get('lieu_reprise');
//        $time = strtotime('10/16/2003');
        $date_prise = $request->query->get('date_prise');
        $date_reprise = $request->query->get('date_reprise');
        $heure_debut = $request->query->get('heure_debut');
        $heure_fin = $request->query->get('heure_fin');
        $voiture = $voitureRepository->findOneBy(['id'=>$id]);
        $reservation = new Reservation();
        $reservation->setLieuPrise($lieu_prise);
        $reservation->setLieuReprise($lieu_reprise);
        $reservation->setDatePrise(\DateTime::createFromFormat('d-m-Y', $date_prise));
        $reservation->setDateReprise(\DateTime::createFromFormat('d-m-Y', $date_reprise));
        $reservation->setHeurePrise($heure_debut);
        $reservation->setHeureReprise($heure_fin);
        $reservation->setHeureReprise($heure_fin);
        $reservation->setIdVoiture($voiture);
        $reservation->setCode($code);
        $session = $this->requestStack->getSession();
        $session->set('code', $code);
        $this->entityManager->persist($reservation);
        $this->entityManager->flush();
//        dd($reservation);
//        dd($voiture);
//        dd(uniqid());

//        $data=$request->request->all();
//        $lieu_prise = $request->query->get('id');
//        dd($lieu_prise);
        return $this->redirectToRoute('app_get_conducteur', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/conducteur", name="app_get_conducteur")
     */
    function get_conducteur(Request $request, ReservationRepository $reservationRepository, ConducteurRepository $conducteurRepository){

        $conducteur = new Conducteur();
        $session = $this->requestStack->getSession();
        $code = $session->get('code');
        $reservation = $reservationRepository->findOneBy(['code'=>$code]);
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conducteur->setReservationId($reservation);
            $this->entityManager->persist($conducteur);
            $this->entityManager->flush();
            return $this->render('client_reservation/reserve/message.html.twig');
        }
//        dd($code);

        return $this->render('client_reservation/reserve/reserve.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
