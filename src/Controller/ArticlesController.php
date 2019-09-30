<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(ArticlesRepository $repo)
    {
    
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }


/**
 * Permet d'afficher une seul annonce
 *
 * @Route("/ads/{libelle}", name="ads_show")
 * 
 * @return Response
 */
    public function show(Articles $ad){
    return $this->render('ad/show.html.twig', [
        'ad' => $ad 
    ]);
    }

}