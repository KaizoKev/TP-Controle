<?php

namespace App\Controller;

use App\Form\AdType;
use App\Entity\Articles;
use App\Repository\AdRepository;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * Permet de crée une annonce
     * @Route("/ads/new", name="ads_create")
     * 
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $ad = new Articles();
        
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($ad);
           $manager->flush(); 

           $this->addFlash(
            'success', 
            "L'annonce <strong>{$ad->getLibelle()}</strong> a bien été enregistrée !");

           return $this->redirectToRoute('ads_show' , [
               'libelle' => $ad->getLibelle()
           ]);
        }

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
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

    /**
     * Permet d'afficher le formulaire d'édition
     * 
     * @Route("/ads/{libelle}/edit", name="ads_edit")
     * 
     * @return Response
     */
    public function edit(Articles $ad, Request $request, ObjectManager $manager){

        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
           $manager->persist($ad);
           $manager->flush(); 

           $this->addFlash(
            'success', 
            "Les modification de l'annonce <strong>{$ad->getLibelle()}</strong> ont bien été enregistrées !");

           return $this->redirectToRoute('ads_show' , [
               'libelle' => $ad->getLibelle()
           ]);
        }

        return $this->render('ad/edit.html.twig', [
            'form' => $form->createView(), 
            'ad' => $ad
        ]);
    }
    
     /**
     * Permet de supprimer une annonce
     * @Route("/ads/{libelle}/delete", name="ads_delete")
     * @param Articles $ad
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Articles $ad, ObjectManager $manager)
    {
        $manager->remove($ad);
        $manager->flush();
        $this->addFlash(
            'success',
            "L'annonce <strong>{$ad->getLibelle()}</strong> a bien été supprimée !"
        );
        return $this->redirectToRoute("liste_articles");
    }

}