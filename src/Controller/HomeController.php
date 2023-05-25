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
     *  @Route("/{customerId}/{packageId}", name="create_reservation",methods={"POST","get"})
     */
    public function createReservation(Request $request, ReservationRepository $reservationRepository, int $customerId = null, int $packageId = null): Response
    {


        $entityManager = $this->getDoctrine()->getManager();
        $customer = $entityManager->getRepository(User::class)->find($customerId);
        $travelPackage = $entityManager->getRepository(TravelPackage::class)->find($packageId);
        dump($customer);
        dump($travelPackage);
        if (!$customer || !$travelPackage) {
            throw $this->createNotFoundException('Customer or Travel Package not found.');
        }

        $reservation = new Reservation();
        dump("before set reservation");
        dump($reservation);
        $reservation->setUser($customer);
        $reservation->setTravelPackage($travelPackage);
        dump("after set reservation");
        dump($reservation);
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        dump("after handle request");
       

        return $this->render('client/home.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }
}
