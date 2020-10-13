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
        //$panier=$session->get('panier',[]);

         /*  $lignes_panier=[];

        foreach($panier as $id_article => $quantite_article){
            $lignes_panier[]= [
                'article' =>  $article = $this->getDoctrine()
                ->getRepository(Article::class)
                ->find($id_article),

                'quantite' => $quantite
            ]; */

        $session = new Session();
            
        if($session->get('panier')){
            
            $id_articles = array_keys($session->get('panier')->getLignesPanier());
        
            $lignes_panier = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->findById($id_articles);

            $quantite = array_count_values($session->get('panier')->getLignesPanier());
        }
        else{
            $lignes_panier= array();
        }
       
        return $this->render('panier/index.html.twig', array('lignes_paniers'=> $lignes_panier));
    }


/**
     * @Route("/panier/add/{id}" , name="panier_add")           //Convention name: controllername_methode
     */
    public function add($id, SessionInterface $session)
    {
        $session = new Session();

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

        dump($session->get('panier'));

        return $this->redirectToRoute('articles');

        dump($session->get('panier'));




    }


}
