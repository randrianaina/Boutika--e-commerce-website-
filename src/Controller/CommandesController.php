<?php
//namespace AppBundle\Controller;
namespace App\Controller;

//use App\Entity\Utilisateurs;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\Routing\Annotation\Route;
//use App\Controller\EntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

//use App\Form\DetailsUtilisateursFormType;


class CommandesController extends AbstractController
{
    /**
     * @Route("/form", name="todo")
     */
    /* public function form_details(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(DetailsUtilisateursFormType::class);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $details_utilisateur = $form->getData();
            //$details_utilisateur -> getEmailUtilisateur($this->get)

            dd($data);

            $em->persist($details_utilisateur);
            $em->flush();
        }

        return $this->render('index.html.twig', [
            'details_utilisateurs' => $form->createView(),
        ]);
    } */
}