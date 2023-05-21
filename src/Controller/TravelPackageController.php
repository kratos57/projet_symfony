<?php

namespace App\Controller;

use App\Entity\TravelPackage;
use App\Form\TravelPackageType;
use App\Repository\TravelPackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class TravelPackageController extends AbstractController
{
    /**
     * @Route("/", name="app_travel_package_index", methods={"GET"})
     */
    public function index(TravelPackageRepository $travelPackageRepository): Response
    {
        return $this->render('Admin/index.html.twig', [
            'travel_packages' => $travelPackageRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="app_travel_package_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TravelPackageRepository $travelPackageRepository): Response
    {
        $travelPackage = new TravelPackage();
        $form = $this->createForm(TravelPackageType::class, $travelPackage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travelPackageRepository->add($travelPackage);
            return $this->redirectToRoute('app_travel_package_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Admin/ajouter.html.twig', [
            'travel_package' => $travelPackage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_travel_package_show", methods={"GET"})
     */
    public function show(TravelPackage $travelPackage): Response
    {
        return $this->render('travel_package/show.html.twig', [
            'travel_package' => $travelPackage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_travel_package_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TravelPackage $travelPackage, TravelPackageRepository $travelPackageRepository): Response
    {
        $form = $this->createForm(TravelPackageType::class, $travelPackage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travelPackageRepository->add($travelPackage);
            return $this->redirectToRoute('app_travel_package_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Admin/modifierVoyage.html.twig', [
            'travel_package' => $travelPackage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_travel_package_delete", methods={"POST"})
     */
    public function delete(Request $request, TravelPackage $travelPackage, TravelPackageRepository $travelPackageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$travelPackage->getId(), $request->request->get('_token'))) {
            $travelPackageRepository->remove($travelPackage);
        }

        return $this->redirectToRoute('app_travel_package_index', [], Response::HTTP_SEE_OTHER);
    }
}
