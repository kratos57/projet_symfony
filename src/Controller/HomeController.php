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

/**
     * @Route("/home/{userId}/{packageId}", name="create_reservation" , methods={"GET","POST"})
     */ 
    public function createReservation(Request $request, ReservationRepository $reservationRepository, UserRepository $userRepository, $userId = null, $packageId): Response
    {
        // Retrieve the User object using the UserRepository and the provided $userId
        $user = $userRepository->find($userId);
    
        // Check if the User object exists
        if (!$user instanceof User) {   
            throw $this->createNotFoundException('User not found.');
        }
    
        // Retrieve the TravelPackage object using the $packageId
        $travelPackage = $this->getDoctrine()->getRepository(TravelPackage::class)->find($packageId);
    
        // Check if the TravelPackage object exists
        if (!$travelPackage instanceof TravelPackage) {
            throw $this->createNotFoundException('Travel Package not found.');
        }
    
        // Create a new Reservation object
        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setTravelPackage($travelPackage);
    
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepository->add($reservation);
            return $this->redirectToRoute('create_reservation', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('client/home.html.twig', [
            'reservation' => $reservation,
            'travel_package' => $travelPackage,
            'form' => $form->createView(),
        ]);
    }
}