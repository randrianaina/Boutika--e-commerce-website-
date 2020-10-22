<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\DetailsUtilisateursType;
use App\Entity\AdresseLivraison;
use App\Repository\UtilisateursRepository;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;


class UtilisateursController extends AbstractController
{   

    /**
     * @Route("/utilisateur/profil", name="utilisateur_profil")
     */
    public function see_details()
    {

        $session = new Session();
        $session->set('utilisateur', $this->getUser());
        $session->get('utilisateur');

        $id = ($session->get('utilisateur')->getId());

        dump($this->getUser());
        dump($id);
       /*  dump($session->get('utilisateur'));
        dump($session->get('utilisateur')->getEmailUtilisateur());
 */
        $utilisateur = $this->getDoctrine()
        ->getRepository(Utilisateurs::class)
        ->find($id);




        return $this->render('utilisateurs/index.html.twig', [
            'utilisateur' => $utilisateur
        ]);
    }
    




    /**
     * @Route("/utilisateur/{id}/edit", name="utilisateur_edit")
     */
    public function add_details(Utilisateurs $utilisateur, Request $request, EntityManagerInterface $em)
    {
        // https://symfonycasts.com/screencast/symfony-forms/update-form
        //installation de SensioFrameworkExtraBundle
        //https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
        $form = $this->createForm(DetailsUtilisateursType::class, $utilisateur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($utilisateur);
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');

            return $this->redirectToRoute('utilisateurs_edit', [
                'id' => $utilisateur->getId(),
            ]);
        }


 
        return $this->render('utilisateurs/edit.html.twig', [
            'userForm' => $form->createView()
        ]);
    }
}


