<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListeController extends AbstractController
{
    /**
     * @Route("/liste", name="liste_articles")
     */
    public function index(ArticlesRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('liste/index.html.twig', [
            'ads' => $ads
        ]);
    }
}
