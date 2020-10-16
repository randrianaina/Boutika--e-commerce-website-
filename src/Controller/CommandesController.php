<?php

namespace AppBundle\Controller;
namespace App\Controller;


use App\Entity\Utilisateurs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandesController extends Controller
{
    /**
     * @Route("/form", name="todo")
     * @IsGranted("ROLE_ADMIN")
     */
    public function form_details(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(Details_Utilisateurs_Type::class, $Entity);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $details_utilisateur = $form->getData();
            //$details_utilisateur -> getEmailUtilisateur($this->get)

            $em->persist($details_utilisateur);
            $em->flush();
        }

        return $this->render('index.html.twig', [
            'details_utilisateurs' => $form->createView(),
        ]);
    }
}