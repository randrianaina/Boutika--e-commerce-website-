<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Commandes;
use App\Entity\Utilisateurs;
use App\Entity\AdresseLivraison;
use App\Form\InfoAdresseLivraisonType;
use App\Repository\AdresseLivraisonRepository;




use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;





class CommandesController extends AbstractController
{
    /**
     * @Route("/commande/new", name="new_commande")
     */
    public function new_commande(EntityManagerInterface $em)
    {   
        //date_default_timezone_set('Australia/Melbourne');
        
        $date = date('d F Y', time());
        //$new_format_date = date('Y-m-d', time());
        /* dd(strftime("%A %d %B %G", strtotime($date)));
        dd($date); */
        
        /* $newdate = date('Y-m-d',strtotime($date[0]));
        dd($newdate);
         *///dd(getdate());
        //dd($date[0]);
        //$datetoaday = $date->setTimestamp()
       
        //$newdate = $date[0]->format('U = Y-m-d H:i:s') . "\n";
        //dd($newdate);

        $session = new Session();

        $panier=($session->get('panier'));
        $id_utilisateur = ($session->get('utilisateur'));

        $new_commande = new Commandes();

        //create an object that implements the DateTimeInterface
        $new_commande->setDateCommande(\DateTime::createFromFormat('d F Y', $date));
        $new_commande->setIdUtilisateur($id_utilisateur);
       /*  $new_commande->setIdTypeLivraison(2);
        $new_commande->setIdAdresseLivraison(3);*/
       // $new_commande->setMontantCommande($session->get('panier')->getMontantPanier());
        dd($new_commande->getIdUtilisateur()->getid());

      /*   $em = persist($new_commande);
        $em = flush(); */
        //dd($id_utilisateur);
        
        dd($new_commande);

        

        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
        ]);
    }

    /**
     * @Route("/commande/all", name="all_commande")
     */
    public function list_commande()
    {
        // transformation de la date en français
        

        /* 
        setlocale(LC_TIME, "fr_FR", "French");
        dd(strftime("%A %d %B %G", strtotime($date)));
        dd($date); */
    }

     /**
     * @Route("utilisateur/commande/shipping_adress", name="adresse_livraison")
     */
    public function new_adresse_livraison(Request $request, EntityManagerInterface $em)
    {
        $adresse = new AdresseLivraison();
        $form = $this->createForm(InfoAdresseLivraisonType::class, $adresse);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($adresse);
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');

            return $this->redirectToRoute('adresse_livraison', [
                /*'id' => $utilisateur->getId(),*/
            ]);
    }

    return $this->render('commandes/addshippingaddress.html.twig', [
        'shipping_address_Form' => $form->createView()
    ]);

}
}