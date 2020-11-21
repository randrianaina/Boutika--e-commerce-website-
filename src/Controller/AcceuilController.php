<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\SousCategories;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function Acceuil(Request $request)
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

            //obtention du nom de la route avec l'objet Request
                // voir https://symfony.com/doc/current/routing.html#getting-the-route-name-and-parameters
            $_route = $request->get('_route');

            //Stockage en session de la route actuelle
            $session->set('current_uri',$_route);

        return $this->render('acceuil/index.html.twig', ['articles' => $articles,
            'controller_name' => 'AcceuilController',
        ]);
    }
}
