<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\SousCategories;
use App\Entity\Categories;
use App\Repository\ArticlesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function All(Request $request)
    {
        $session = new Session();


        $depot= $this->getDoctrine()->getRepository(Articles::class);
        $articles= $depot->findAll();
        if (!$articles) {
            throw $this->createNotFoundException('Pas d\'articles trouvés ...!');
        }

        //obtention du nom de la route avec l'objet Request
                // voir https://symfony.com/doc/current/routing.html#getting-the-route-name-and-parameters
                $_route = $request->get('_route');

                //Stockage en session de la route actuelle
                $session->set('current_uri',$_route);

        return $this->render('articles/index.html.twig', ['articles'=>$articles,
            'controller_name' => 'ArticlesController',
        ]);


    }

    /**
     * @Route("/souscategories/{id}", name="souscategorie")
     */
    public function Souscategories($id)
    {
        $sous_categorie = $this->getDoctrine()
        ->getRepository(SousCategories::class)
        ->find($id);

        $articles = $sous_categorie->getArticles();

        return $this->render('articles/sous_categories.html.twig', ['articles'=>$articles,
            'controller_name' => 'ArticlesController','sous_categorie' =>$sous_categorie
        ]);
    }

    /**
     * @Route("/categories/{id}", name="categorie")
     */
    public function Categories($id)
    {
        $categorie = $this->getDoctrine()
        ->getRepository(Categories::class)
        ->find($id);

        $sous_categories = $categorie->getSousCategories();

        return $this->render('articles/categories.html.twig', ['sous_categories' =>$sous_categories,
            'controller_name' => 'ArticlesController','categorie' =>$categorie
        ]);
    }

    /**
     * @Route("/article/{id}/details", name="article_details")
     */
    public function Details($id)
    {
        $Article = $this->getDoctrine()
        ->getRepository(Articles::class)
        ->find($id);

        //obtention du nom de la route avec l'objet Request
                // voir https://symfony.com/doc/current/routing.html#getting-the-route-name-and-parameters
                $_route = $request->get('_route');

                //Stockage en session de la route actuelle
                $session->set('current_uri',$_route);

        return $this->render('articles/details.html.twig', ['article' =>$Article
        ]);
    }


  
}
