<?php
namespace App\Controller;
use App\Entity\Reservation;
use App\Entity\TravelPackage;
use App\Entity\User;

use App\Repository\ReservationRepository;
use App\Repository\UserRepository;

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
        return $this->render('client/home.html.twig', [
            'travel_packages' => $travelPackageRepository->findAll(),
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
 * @Route("/", name="create_reservation",methods={"POST","get"})
 */
public function createReservation(Request $request, ReservationRepository $reservationRepository ): Response
{
    $customerId = $request->request->get('customerId');
    $packageId = $request->request->get('packageId');

    $entityManager = $this->getDoctrine()->getManager();

    $customer = $entityManager->getRepository(User::class)->find($customerId);
    $travelPackage = $entityManager->getRepository(TravelPackage::class)->find($packageId);

    if (!$customer || !$travelPackage) {
        throw $this->createNotFoundException('Customer or Travel Package not found.');
    }

    $reservation = new Reservation();
    $reservation->setUser($customer);
    $reservation->setTravelPackage($travelPackage);
    
    $form = $this->createForm(ReservationType::class, $reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $reservationRepository->add($reservation);
        return $this->redirectToRoute('create_reservation', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('client/home.html.twig', [
        'reservation' => $reservation,
        'form' => $form->createView(),
    ]);
}




}

