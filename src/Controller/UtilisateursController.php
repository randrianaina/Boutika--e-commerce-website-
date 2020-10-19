<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateurs;
use App\Entity\AdresseLivraison;

class UtilisateursController extends AbstractController
{
    /**
     * @Route("/utilisateurs", name="utilisateurs")
     */
    public function add_details()
    {
        dump($this->getUser());
        return $this->render('utilisateurs/index.html.twig', [
            'controller_name' => 'UtilisateursController',
        ]);
    }
}
