<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateursRepository;
use App\Entity\Utilisateurs;
use App\Form\DetailsUtilisateursType;
use App\Entity\AdresseLivraison;


class UtilisateursController extends AbstractController
{   

    /**
     * @Route("/utilisateurs/{id}", name="utilisateurs_profil")
     */
    public function see_details($id)
    {

        $session = new Session();
        $session->set('utilisateur', $this->getUser());
        $session->get('utilisateur');

        $id = ($session->get('utilisateur')->getId());
       /*  dump($session->get('utilisateur'));
        dump($session->get('utilisateur')->getEmailUtilisateur());
 */
        $utilisateur = $this->getDoctrine()
        ->getRepository(Utilisateurs::class, $utilisateur)
        ->find($id);




        return $this->render('utilisateurs/index.html.twig', [
            'Utilisateur' => $utilisateur
        ]);
    }
    




    /**
     * @Route("/utilisateurs/{email_utilisateur}/edit", name="utilisateurs_edit")
     */
    public function add_details(Utilisateurs $utilisateur, Request $request, EntityManagerInterface $em)
    {
        // https://symfonycasts.com/screencast/symfony-forms/update-form
        //installation de SensioFrameworkExtraBundle
        //https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
        /* dump($this->getUser());

       
        $session = new Session();
        $session->set('utilisateur', $this->getUser());
        $session->get('utilisateur');

        $email_utilisateur = ($session->get('utilisateur')->getEmailUtilisateur());
        dump($session->get('utilisateur'));
        dump($session->get('utilisateur')->getEmailUtilisateur());


        $utilisateur = $this->getDoctrine()
        ->getRepository(Utilisateurs::class, $utilisateur)
        ->findOneBy(['email_utilisateur'=>$email_utilisateur]);

        $utilisateur = new Utilisateurs();

        $utilisateur->setCiviliteUtilisateur();
        $utilisateur->setNomUtilisateur();
        $utilisateur->setPrenomUtilisateur();
        $utilisateur->setAdresseUtilisateur();
        $utilisateur->setCpUtilisateur();
        $utilisateur->setVilleUtilisateur(); */

        $form = $this->createForm(DetailsUtilisateursType::class, $utilisateur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($utilisateur);
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');

            return $this->redirectToRoute('utilisateurs_edit', [
                'email_utilisateur' => $utilisateur->getEmailUtilisateur(),
            ]);
        }


 
        return $this->render('utilisateurs/edit.html.twig', [
            'userForm' => $form->createView()
        ]);
    }
}


