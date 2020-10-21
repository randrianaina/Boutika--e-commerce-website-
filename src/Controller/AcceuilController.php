<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\SousCategories;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function Acceuil()
    {
        $session = new Session();

        $depot= $this->getDoctrine()->getRepository(Articles::class);
        $articles= $depot->findAll();
        if (!$articles) {
            throw $this->createNotFoundException('Pas d\'articles trouvés ...!');
        }

        $souscategories = $this->getDoctrine()
            ->getRepository(SousCategories::class)
            ->findAll();
            if (!$souscategories) {
                throw $this->createNotFoundException('Pas de sous catégories trouvés ...!');
            }

        $categories = $this->getDoctrine()
            ->getRepository(Categories::class)
            ->findAll();
            if (!$categories) {
                throw $this->createNotFoundException('Pas de catégories trouvés ...!');
            }

            dump($session->getName());
            dump($session->get('panier'));
            dump($session->get('user'));
            dump($session->get('Utilisateurs'));
            //dd($this->getUser());



        return $this->render('acceuil/index.html.twig', ['articles' => $articles,
            'controller_name' => 'AcceuilController',
        ]);
    }
}
