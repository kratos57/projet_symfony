<?php
namespace App\Controller;

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
     * @Route("/test", name="app_travel_package_index", methods={"GET"})
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
    public function recherche(Request $request, TravelPackageRepository $travelPackageRepository): Response
    {
        $query = $request->query->get('query'); // Récupère le paramètre de recherche

        if ($query !== null) {
            // Effectuez votre logique de recherche ici
            $voyages = $travelPackageRepository->searchByDestination($query);
        } else {
            // Effectuez une autre logique si aucun paramètre de recherche n'est spécifié
            $voyages = $travelPackageRepository->findAll();
        }

        return $this->render('client/home.html.twig', [
            'voyages' => $voyages,
        ]);
    }
}
