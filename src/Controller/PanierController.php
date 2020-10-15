<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Panier;
use App\Entity\Utilisateurs;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;


class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function all(SessionInterface $session)
    {
        $session = new Session();
            
        if($session->get('panier')){
            
            $id_articles = array_keys($session->get('panier')->getLignesPanier());
        
            $lignes_panier = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->findById($id_articles);

           
        }
        else{
            $lignes_panier= array();
        }
        $panier=($session->get('panier'));
        $total_quantite = array_sum($panier->getLignesPanier());
      /*   */



        dump($session->get('panier')->getLignesPanier());
        $tableau = ($session->get('panier')->getLignesPanier());

       dump( array_sum($session->get('panier')->getLignesPanier()));
       dump($total_quantite);
       dump($lignes_panier);

       // quantité article
       dump(array_values($session->get('panier')->getLignesPanier()));
       
        $tableau2 = array();
       foreach ($tableau as $id => $quantite){
            $tableau2[]= [
                'article' => $this->getDoctrine()
                ->getRepository(Articles::class)->find($id),
                'quantite' => $quantite
            ];
       }

       $total = 0 ;
       foreach ($tableau2 as $item)
       {
           $totalitem = $item['article']->getPrixTtcArticle() * $item['quantite'];
           $total += $totalitem;
       }

       $panier->setMontantPanier($total);

       $session->set('panier', $panier);


      
       dump($tableau2[0]);
       dump($totalitem);
       dump($item);
       dump($total);

       /* foreach ($lignes_panier as $ligne_panier){
        $ligne_panier->getPrixTtcArticle() * $session->get('panier')->getLignesPanier();
       } */
       dump($tableau);
       dump($tableau2);
       dump($lignes_panier);
       dump($panier);
       
       //dump(($ligne_panier->getPrixTtcArticle()) * ($session->get('panier')->getLignesPanier()));

        return $this->render('panier/index.html.twig', array('lignes_paniers'=> $lignes_panier, 'total_quantite'=>$total_quantite , 'Montant_total' =>$total));
    }

    /**
     * @Route("/panier/{id}/add" , name="panier_art_add")           //Convention name: controllername_methode
     */
    public function add($id, SessionInterface $session)
    {
        $session = new Session();

        $panier = $session->get('panier');

        //si aucun panier existe, créé un nouveau panier
        if (!$session->get('panier')) {
            $session->set('panier', new Panier());
        }

        $panier = $session->get('panier');
        // On recupere $panier dans la SESSION
        // ^^ Valeur par default
        $panier->add_ligne($id);

        $session->set('panier', $panier);
        // Pour garder dans la SESSION l'etat actuel du $panier

        //dump($session->get('panier'));

        return $this->redirectToRoute('articles');

        //dump($session->get('panier'));

    }

    /**
     * @Route("/panier/{id}/remove" , name="panier_art_remove")           //Convention name: controllername_methode
     */
    public function remove($id, SessionInterface $session)
    {
        $session = new Session();
        $panier = $session->get('panier');
        $panier->del_all_ligne($id);
        $session->set('panier', $panier);
        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/{id}/quantity+" , name="panier_art_++")           //Convention name: controllername_methode
     */
    public function quantityadd($id, SessionInterface $session)
    {
        $session = new Session();

        $panier = $session->get('panier');

         //si aucun panier existe, créé un nouveau panier
         if (!$session->get('panier')) {
            $session->set('panier', new Panier());
        }

        $panier = $session->get('panier');

        $panier->add_ligne($id);

        $panier = $session->set('panier',$panier);

        return $this->redirectToRoute('panier');

    }

    /**
     * @Route("/panier/{id}/quantity-" , name="panier_art_--")           //Convention name: controllername_methode
     */
    public function quantityremove($id, SessionInterface $session)
    {
        $session = new Session();
        $panier = $session->get('panier');
         //si aucun panier existe, créé un nouveau panier
      /*    if (!$session->get('panier')) {
            $session->set('panier', new Panier());
        } */
       /*  $panier = $session->get('panier'); */
        $panier->del_ligne($id);
        $session->set('panier',$panier);
        return $this->redirectToRoute('panier');

    }
}
