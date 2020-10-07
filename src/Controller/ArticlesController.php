<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function All()
    {
        $depot= $this->getDoctrine()->getRepository(Articles::class);
        $articles= $depot->findAll();
        if (!$articles) {
            throw $this->createNotFoundException('Pas d\'articles trouvés ...!');
        }

        return $this->render('articles/index.html.twig', ['articles'=>$articles,
            'controller_name' => 'ArticlesController',
        ]);
    }
}
