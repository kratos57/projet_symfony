<?php
namespace App\Controller;
<<<<<<< HEAD
use App\Entity\Customer;
=======
>>>>>>> 7ae631587f1b05cf6f2d800218144931583c3554
use App\Entity\Reservation;
use App\Entity\TravelPackage;
use App\Form\TravelPackageType;
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
<<<<<<< HEAD
  /**
     * @Route("/", name="create_reservation", methods={"Post"})
     */
    public function createReservation(int $customerId, int $packageId): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Get the customer by ID
        $customer = $entityManager->getRepository(User::class)->find($customerId);

        // Get the travel package by ID
        $package = $entityManager->getRepository(TravelPackage::class)->find($packageId);

        // Check if the customer and travel package exist
        if (!$customer || !$package) {
            throw $this->createNotFoundException('Customer or Travel Package not found.');
        }

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->setUser($customer);
        var_dump($reservation);

        $reservation->setTravelPackage($package);
        var_dump($reservation);
        // Persist the reservation to the database
        $entityManager->persist($reservation);
        $entityManager->flush();

        // Return a response indicating success
        return new Response('Reservation created successfully!');
    }


=======
  
>>>>>>> 7ae631587f1b05cf6f2d800218144931583c3554

}

