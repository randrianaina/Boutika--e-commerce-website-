<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\SousCategories;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil")
     */
    public function Acceuil()
    {
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

        return $this->render('acceuil/index.html.twig', ['articles' => $articles,
            'controller_name' => 'AcceuilController',
        ]);
    }
}
