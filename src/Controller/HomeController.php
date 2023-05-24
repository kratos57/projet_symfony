<?php
namespace App\Controller;
use App\Entity\Reservation;
use App\Entity\TravelPackage;
use App\Form\TravelPackageType;
use App\Repository\TravelPackageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="article_list", methods={"GET"}) 
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
     * Route('/voyage/reservation', name: 'voyage_reservation')
     */
    public function reservation(Request $request): Response
    {

        $destination = $request->request->get('destination');
        $prix = $request->request->get('prix');

        // Récupérer les informations sur le client qui effectue la réservation
        $user = $this->getUser(); // Supposons que vous utilisez l'authentification

        // Créer et enregistrer la réservation
        $reservation = new Reservation();
    
        $reservation->setDestination($destination);
        $reservation->setPrix($prix);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reservation);
        $entityManager->flush();

        // Réponse de confirmation
        return new Response('Réservation effectuée avec succès !');
    }

}
