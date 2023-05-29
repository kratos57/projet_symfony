<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\TravelPackage;
use App\Entity\User;

use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use App\Form\ReservationType ;
use App\Repository\TravelPackageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="article_list", methods={"GET"}) 
     */
    public function index(TravelPackageRepository $travelPackageRepository): Response
    {
        $travelPackages = $travelPackageRepository->findAll();

        return $this->render('client/home.html.twig', [
            'travel_packages' => $travelPackages,
        ]);
    }


    /**
     * @Route("/recherche", name="recherche")
     */
    public function recherche(Request $request)
    {
        $destination = $request->query->get('destination');
        $travelPackage = [];

        if ($destination) {
            $travelPackage = $this->getDoctrine()->getRepository(TravelPackage::class)->searchByDestination($destination);
        }

        return $this->render('client/home.html.twig', [
            'travel_packages' => $travelPackage,
            'destination' => $destination,
        ]);
    }

   

    /**
     * @Route("/reservation/success", name="reservation_success")
     */
    public function reservationSuccess(): Response
    {
        return new Response('Reservation successful!');
    }


}