<?php

namespace App\Controller;

use App\Repository\SiteRepository;
use App\Repository\ForumRepository;
use App\Repository\AccueilRepository;
use App\Repository\SubgroupRepository;
use App\Repository\RessourceRepository;
use App\Repository\SpecialiteRepository;
use App\Repository\CoordinateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\SecretaireGeneralRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
           
        ]);
    }

    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(AccueilRepository $accueilRepository): Response
    {
       
        return $this->render('home/accueil.html.twig', [
            'accueil' => $accueilRepository->findAll()[0]?? null,
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(
        SubgroupRepository $subgroupRepository, 
        SecretaireGeneralRepository $secretaireGeneralRepository,
        CoordinateurRepository $coordinateurRepository,
        SiteRepository $siteRepository,
        ): Response
    {
        // Récuperer les données des membres appartenant au même groupe
        
        return $this->render('home/about.html.twig', [
            'subgroups' => $subgroupRepository->findAll(),
            'secretaires' => $secretaireGeneralRepository->findAll(),
            'coordinateurs' => $coordinateurRepository->findAll(),
            'sites' => $siteRepository->findAll(),
        ]);
    }

    #[Route('/ressource', name:'app_ressource')]
    public function ressource(RessourceRepository $ressource, SpecialiteRepository $specialiteRepository):Response
    {
        $specialities = $specialiteRepository->findAll();   
        return $this->render('ressource/comes.html.twig',[
            'ressource' => $ressource->findAll()[0]?? null,
            'specialities' => $specialities,
        ]);
    }

    #[Route('/forum', name:'app_forum')]
    public function forum(ForumRepository $forumRepository):Response
    {
        $forum = $forumRepository->findAll();
        //dd($forum);
        return $this->render('home/forum.html.twig',[
            'forum' => $forum,
        ]);
    }
}
