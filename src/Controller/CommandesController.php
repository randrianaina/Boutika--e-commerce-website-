<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Panier;
use App\Entity\Commandes;
use App\Entity\Utilisateurs;
use App\Entity\AdresseLivraison;
use App\Entity\TypesLivraison;


use App\Form\AddAdresseLivraisonType;
use App\Form\SelectAdresseLivraisonType;
use App\Form\SelectTypeLivraisonType;


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
     * @Route("utilisateur/{id}/commande/shipping_adress", name="adresse_livraison")
     */
    public function new_adresse_livraison(Request $request, EntityManagerInterface $em)
    {
        $adresse = new AdresseLivraison();
        $form = $this->createForm(AddAdresseLivraisonType::class, $adresse);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* dd($adresse); */
            $em->persist($adresse);

            
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');

            return $this->redirectToRoute('adresse_livraison', [
                'id' => $this->getUser()->getId(),
            ]);
    }

    return $this->render('commandes/addshippingaddress.html.twig', [
        'shipping_address_Form' => $form->createView()
    ]);

}


/**
 * @Route("/utilisateur/commande/etape1", name="commande_etape1")
 */
public function select_adresse_livraison(Request $request, EntityManagerInterface $em)
{
    $session = new Session();

    $session->set('utilisateur', $this->getUser());
    $session->get('utilisateur');

    $id = ($session->get('utilisateur')->getId());
    
   /*  $adresses_livraison = $this->getDoctrine()
    ->getRepository(AdresseLivraison::class)
    ->findBy(array('id_utilisateur' => $id)); */

   /*  $adresse = new AdresseLivraison();
 */
    $form = $this->createForm(SelectAdresseLivraisonType::class/* , $adresse */);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        
        //https://symfony.com/doc/current/form/without_class.html
        //getData() method store data without a class
        $data= $form->getData();


        //store the selected shipping adress
        $session->set('ad_livraison', $data);


        //getting the id of the shipping adress
        foreach ($data as $ad_livraison){
            $session->set('id_ad_livraison', $ad_livraison->getId());
        }

        //dd($session->get('id_ad_livraison'));
        //dd($session->get('ad_livraison'));
        
        //dd($data);
        //dd($data);
        
        /* dd($adresse); 
        $em->persist($adresse);

        
        $em->flush(); */

        $this->addFlash('success', 'Adresse sélectionnée !');

        
        return $this->redirectToRoute('Commande_etape2');
}
    
    return $this->render('commandes/step1order.html.twig', ['select_adresse_livraison_Form' => $form->createView()
    ]);
}

/**
 * @Route("/utilisateur/commande/etape2", name="Commande_etape2")
 */
public function select_type_livraison(Request $request, EntityManagerInterface $em)
{
    $session = new Session();

   /*  $session->set('utilisateur', $this->getUser());
    $session->get('utilisateur');

    $id = ($session->get('utilisateur')->getId());
     */
   /*  $adresses_livraison = $this->getDoctrine()
    ->getRepository(AdresseLivraison::class)
    ->findBy(array('id_utilisateur' => $id)); */

   /*  $adresse = new AdresseLivraison();
 */
    $form = $this->createForm(SelectTypeLivraisonType::class/* , $adresse */);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        
        //https://symfony.com/doc/current/form/without_class.html
        //getData() method store data without a class
        $data= $form->getData();


        //store the selected shipping adress
        $session->set('type_livraison', $data);


        //getting the id and the price of the shipping adress
        foreach ($data as $type_livraison){
            //store the id on the session
            $session->set('id_type_livraison', $type_livraison->getId());

            //store the price on the session
            $session->set('frais_type_livraison', $type_livraison->getFraisLivraison());
        }

        //dd($session->get('id_type_livraison'));
        //dd($session->get('frais_type_livraison'));

        //dd($session->get('ad_livraison'));
        
        //dd($data);
        //dd($data);
        
        /* dd($adresse); 
        $em->persist($adresse);

        
        $em->flush(); */

        $this->addFlash('success', 'Adresse sélectionnée !');

        
        return $this->redirectToRoute('RouteName', [
            'id' => $this->getUser()->getId(),
        ]);
}
    
    return $this->render('commandes/step2order.html.twig', ['select_type_livraison_Form' => $form->createView()
    ]);
}

/**
 * @Route("/utilisateur/commande/etape3", name="Commande_etape3")
 */
public function see_commande_detail()
{
    $session = new Session();

    $panier = $session->get('panier')->getLignesPanier();

    $id_articles = array_keys($session->get('panier')->getLignesPanier());
    
    //lignes du panier (tableau)
    $lignes_panier = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->findById($id_articles);
    
    
    //Montant panier
    $montant_panier = $session->get('panier')->getMontantPanier();
    dump($montant_panier);

    //Adresse de livraison (tableau)
    $adresses_livraison = $session->get('ad_livraison');
    foreach($adresses_livraison as $adresse_livraison ){
        dump($adresse_livraison->getNomContact());
        dump($adresse_livraison->getPrenomContact());

    }
    


    //frais de livraison
    $frais_livraison = $session->get('frais_type_livraison');
    dump($frais_livraison);
     
    
    return $this->render('commandes/step3order.html.twig'/* , array('lignes_paniers'=>$lignes_panier) */);
}
}