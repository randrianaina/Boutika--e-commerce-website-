<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Panier;
use App\Entity\Utilisateurs;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

//Injection du service Session dans le controller 
use Symfony\Component\HttpFoundation\Session\Session;


class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function all(SessionInterface $session)
    {
        //déclaration de la variable $session par l'appel de l'objet Session 
        $session = new Session();

         //le programme récupère de nouveau des données dans la session
         $panier=($session->get('panier'));

         //déclaration d'une variable pour une utilisation ultérieure
         $total_quantite=0;
        
        //s'il y a des données après avoir fait appel à l'attribut panier dans la session
        if($panier){
            //On fait appel à la méthode getLignesPanier() de class Panier pour résortir les informations stockés sous forme de tableau 
                // et on retourne dans la variable $id_articles toutes les clés du tableau panier dans la session la fonction PHP array_keys 
            $id_articles = array_keys($session->get('panier')->getLignesPanier());
        
            //on utilise les clés du tableau (ici les id des articles) pour récupérer plusieurs objets Articles dans BDD dans la variable $lignes_panier
            $lignes_panier = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->findById($id_articles);

             //somme des valeurs des clés du tableau
            $total_quantite = array_sum($panier->getLignesPanier());
        
            //stockage de la somme dans l'attribut total_quantité de la session pour une utilisation ultérieure
            $session->set('total_quantite' ,$total_quantite);
        }

        //s'il n'y a aucunes données dans l'attribut panier de la session alors , le rogramme créé un tableau vide ($lignes_panier)
            // et stocke un nouvel attribut panier dans la session en se basant sur un nouvel objet Panier pour un utilisation ultérieure
        else{
            $lignes_panier= array();
            $session->set('panier',new Panier);
        }
        
        //On fait appel à la méthode getLignesPanier() de class Panier pour résortir les informations stockés sous forme de tableau 
        $tableau = ($session->get('panier')->getLignesPanier());
       
        //déclaration d'un nouveau tableau pour y stocker les informations sur les articles mis en panier et leur quantités
        $tableau2 = array();

        //$tableau : $id = clé / $quantite = valeur 
       foreach ($tableau as $id => $quantite){
            $tableau2[]= [
                'article' => $this->getDoctrine()
                ->getRepository(Articles::class)->find($id),
                'quantite' => $quantite
            ];
       }
       //calcul du prix total du panier
       $total = 0 ;
       foreach ($tableau2 as $item)
       {
           $totalitem = $item['article']->getPrixTtcArticle() * $item['quantite'];
           $total += $totalitem;
           
       }
       /* dd($total); */
      /*  if(empty($total)){
        $panier->setMontantPanier(0);
       } */
       $panier->setMontantPanier($total);
       $session->set('panier', $panier);
        return $this->render('panier/index.html.twig', array('lignes_paniers'=> $lignes_panier, 'total_quantite'=>$total_quantite , 'Montant_total' =>$total));
    }

    /**
     * @Route("/panier/{id}/add" , name="panier_art_add")           
     */
    public function add($id)
    {
        $session = new Session();

        //Le programme récupère les données stockées le tableau panier dans la session
        $panier = $session->get('panier');

        //si aucunes données existent, le programme créé un nouveau panier vide
        if (!$session->get('panier')) {
            $session->set('panier', new Panier());
        }

        //Le programme récupère les données stockées le tableau panier dans la session vers un variable
        $panier = $session->get('panier');
        
        //rajoute les données relatives à un article par son id dans la variable par la méthode add_ligne($id) de l'entité Panier
        $panier->add_ligne($id);

        //enregistre les modifications dans le tableau panier de la session
        $session->set('panier', $panier);
        
        //Redirection vers la dernière route sauvegardée en session pour une meilleure UX, ici routes : accueil ou articles ou article_details 
        return $this->redirectToRoute($session->get('current_uri'));
    }

    /**
     * @Route("/panier/{id}/remove" , name="panier_art_remove")           
     */
    public function remove($id, SessionInterface $session)
    {   
        //déclaration de la variable $session par l'appel de l'objet Session 
        $session = new Session();

        //le programme récupère de nouveau des données dans la session 
        $panier = $session->get('panier');

        //suppression de la ligne de produits concernés par la méthode del_all_ligne($id) de l'entité Panier
        $panier->del_all_ligne($id);

        //sauvegarde des données en session
        $session->set('panier', $panier);
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/{id}/quantity+" , name="panier_art_++")     
     */
    public function quantityadd($id, SessionInterface $session)
    {
        //déclaration de la variable $session par l'appel de l'objet Session 
        $session = new Session();

         //le programme récupère de nouveau des données dans la session 
        $panier = $session->get('panier');

         //si aucunes données n'est récupéré, créé un nouveau panier
         if (!$session->get('panier')) {
            $session->set('panier', new Panier());
        }

        //le programme récupère de nouveau des données dans la session 
        $panier = $session->get('panier');

        //rajoute en valeur (en quantité) le produit séléctionné dans le panier
        $panier->add_ligne($id);

        //sauvegarde du panier
        $panier = $session->set('panier',$panier);

        return $this->redirectToRoute('panier');

    }

    /**
     * @Route("/panier/{id}/quantity-" , name="panier_art_--")   
     */
    public function quantityremove($id, SessionInterface $session)
    {
        //déclaration de la variable $session par l'appel de l'objet Session 
        $session = new Session();

         //le programme récupère de nouveau des données dans la session 
        $panier = $session->get('panier');

        //décrémente en valeur (en quantité) le produit séléctionné dans le panier
        $panier->del_ligne($id);

         //sauvegarde du panier
        $session->set('panier',$panier);
        return $this->redirectToRoute('panier');
    }
}
