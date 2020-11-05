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

//utilisation de SensioFrameworkExtraBundle pour l'utilisation d'annotations pour limiter l'accès à certains contrôlleurs
    //voir https://symfony.com/doc/current/security.html#security-securing-controller
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class UtilisateursController extends AbstractController
{   

    /**
     * @Route("/utilisateur/profil", name="utilisateur_profil")
     * Require ROLE_USER for *every* controller method in this class.
     *   
     * @IsGranted("ROLE_USER")
     */
    public function see_details()
    {

        $session = new Session();
        $session->set('utilisateur', $this->getUser());
        $session->get('utilisateur');

        $id = ($session->get('utilisateur')->getId());

        dump($this->getUser()->getId());
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
     * Require ROLE_USER for *every* controller method in this class.
     * 
     * @IsGranted("ROLE_USER")
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

            return $this->redirectToRoute('utilisateur_profil');
        }


 
        return $this->render('utilisateurs/edit.html.twig', [
            'userForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/utilisateur/adresses_livraison", name="list_adresse_livraison")
     * Require ROLE_USER for *every* controller method in this class.
     *  
     * @IsGranted("ROLE_USER")
     */
    public function see_shipping_address()
    {
        $session = new Session();
        $session->set('utilisateur', $this->getUser());
        $session->get('utilisateur');

        $id = ($session->get('utilisateur')->getId());

        dump($this->getUser()->getId());
        dump($id);

        $adresses_livraison = $this->getDoctrine()
        ->getRepository(AdresseLivraison::class)
        ->findBy(array('id_utilisateur' => $id));




        return $this->render('utilisateurs/listshippingaddress.html.twig', [
            'adresses_livraison' => $adresses_livraison
        ]);
    }
    }


