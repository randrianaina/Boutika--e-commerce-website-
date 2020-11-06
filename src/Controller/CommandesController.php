<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Panier;
use App\Entity\Commandes;
use App\Entity\Utilisateurs;
use App\Entity\AdresseLivraison;
use App\Entity\TypesLivraison;
use App\Entity\LigneCommandes;


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

//utilisation de SensioFrameworkExtraBundle pour l'utilisation d'annotations pour limiter l'accès à certains contrôlleurs
    //voir https://symfony.com/doc/current/security.html#security-securing-controller
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;




class CommandesController extends AbstractController
{
   

    /**
     * @Route("/commande/all", name="all_commande")
     * Require ROLE_USER for *every* controller method in this class.
     * 
     * @IsGranted("ROLE_USER")
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
 * Require ROLE_USER for *every* controller method in this class.
 *
 * @IsGranted("ROLE_USER")
 */
public function select_adresse_livraison(Request $request, EntityManagerInterface $em)
{
    $session = new Session();

    $session->set('utilisateur', $this->getUser());
    $session->get('utilisateur');

    $id = $this->getUser()->getId();
    
    $form = $this->createForm(SelectAdresseLivraisonType::class/* , $adresse */);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        
        //https://symfony.com/doc/current/form/without_class.html
        //getData() method store data without a class
        $data= $form->getData();

        //store the selected shipping adress
        $session->set('adresse_livraison', $data['adresselivraison']);

        $this->addFlash('success', 'Adresse sélectionnée !');

        return $this->redirectToRoute('Commande_etape2');
}
    return $this->render('commandes/step1order.html.twig', ['select_adresse_livraison_Form' => $form->createView()
    ]);
}

/**
 * @Route("/utilisateur/commande/etape2", name="Commande_etape2")
 * Require ROLE_USER for *every* controller method in this class.
 *  
 * @IsGranted("ROLE_USER")
 */
public function select_type_livraison(Request $request, EntityManagerInterface $em)
{
    $session = new Session();

    $form = $this->createForm(SelectTypeLivraisonType::class);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        
        //https://symfony.com/doc/current/form/without_class.html
        //getData() method store data without a class
        $data= $form->getData();

        //store the selected shipping adress
        $session->set('type_livraison', $data['type_livraison']);
        
        $this->addFlash('success', 'Adresse sélectionnée !');

        return $this->redirectToRoute('Commande_etape3');
}
    return $this->render('commandes/step2order.html.twig', ['select_type_livraison_Form' => $form->createView()
    ]);
}

/**
 * @Route("/utilisateur/commande/etape3", name="Commande_etape3")
 * Require ROLE_USER for *every* controller method in this class.
 *  
 * @IsGranted("ROLE_USER")
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
    $adresse_livraison = $session->get('adresse_livraison');

    
    //type de livraison
    $type_livraison =  $session->get('type_livraison');

    //frais de livraison
    $frais_livraison = $session->get('frais_type_livraison');

    //Total montant commande
    $total = $montant_panier+$frais_livraison;
   
    $session->set('total_commande',$total);
     
    return $this->render('commandes/step3order.html.twig', array('lignes_panier'=>$lignes_panier, 
    'montant_panier'=>$montant_panier, 'adresse_livraison'=>$adresse_livraison, 'type_livraison'=>$type_livraison,'frais_de_livraison'=>$frais_livraison, 'total'=>$total ));
}

/**
 * @Route("/utilisateur/commandes", name="commandes")
 * Require ROLE_USER for *every* controller method in this class.
 *  
 * @IsGranted("ROLE_USER")
 */
public function see_commandes()
{
    $session = new Session();
    $id = $this->getUser()->getId();
    $commandes = $this->getDoctrine()
    ->getRepository(Commandes::class)
    ->findBy(array('id_utilisateur' => $id));

    foreach ($commandes as $commande){
        
        $id_type_livraison=$commande->getIdTypeLivraison()->getId();
        $id_adresse_livraison=$commande->getIdAdresseLivraison()->getId();
    }

    $adresses_livraison = $this->getDoctrine()
    ->getRepository(AdresseLivraison::class)
    ->findBy(array('id_utilisateur' => $id));
    
    return $this->render('utilisateurs/orders.html.twig', [
        'commandes' => $commandes
    ]);
}

    /**
     * @Route("/commande/new", name="new_commande")
     * Require ROLE_USER for *every* controller method in this class.
     *   
     * @IsGranted("ROLE_USER")
     */
    public function new_commande(EntityManagerInterface $em)
    {   
        //PROBLEME : les setters de l'entity Commandes, n'acceptent pas d'autre données (array, int, ...) à part une instance de class ou un null
            //SOLUTION : Il faut accéder aux données telles 
                //qu'elles sont organisées dans la class (ici class Commandes donc tableau accédant à donc l'instancier
                    // à id, date_commande, id_type_livraison, id_adresse_livraison, montant, id_utilisateur)
                     // faire un dd($session->get('type_livraison')) pour un aperçu
        $date = date('d F Y', time());
        $id_utilisateur = $this->getUser()->getId();
        $session = new Session();
        
        $new_commande = new Commandes();
        
        $adresselivraison = $this->getDoctrine()
            ->getRepository(AdresseLivraison::class)
            ->findById($session->get('adresse_livraison')->getId());

        //dd($session->get('type_livraison'));
        $typeLivraison = $this->getDoctrine()
            ->getRepository(TypesLivraison::class)
            ->findById($session->get('type_livraison')->getId());
        
        $new_commande->setIdTypeLivraison($typeLivraison[0]);
        $new_commande->setIdAdresseLivraison($adresselivraison[0]);
        $new_commande->setMontantCommande($session->get('total_commande'));
        
        //create an object that implements the DateTimeInterface
        $new_commande->setDateCommande(\DateTime::createFromFormat('d F Y', $date));
        $new_commande->setIdUtilisateur($this->getUser());

        $session->set('commande', $new_commande);

        $em = $this->getDoctrine()->getManager();
        $em->persist($new_commande);
        $em->flush(); 
        
        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
        ]);
    }



    
}