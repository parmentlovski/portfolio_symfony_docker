<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ProjetRepository;
use App\Repository\ReseauxRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function index(ReseauxRepository $reseauxRepo, ServiceRepository $serviceRepo, UserRepository $userRepo, ProjetRepository $projetRepo)
    {

        $reseaux = $reseauxRepo->findAll();
        $services = $serviceRepo->findAll();
        $users = $userRepo->findOneBy([], ['id' => 'asc']);
        $projets = $projetRepo->findOneBy([], ['id' => 'desc']);

        return $this->render('admin/dashboard/index.html.twig', [
            'reseaux' => $reseaux,
            'services' => $services,
            'users' => $users,
            'projets' => $projets
        ]);
    }
}
