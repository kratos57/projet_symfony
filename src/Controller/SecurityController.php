<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SecurityController extends AbstractController
{
   /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface  $em)
    {
        $user = new User();
        $form  = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form->isValid()) {
        //l'objet $em sera affecté automatiquement grâce à l'injection des dépendances de symfony 4  
           $em->persist($user);
           $em->flush();  
        }
       return $this->render('security/registration.html.twig', 
                           ['form' =>$form->createView()]);
    }
}
