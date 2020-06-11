<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
     /**
     * @Route("/", name="homepage")
     */
    public function home(UserRepository $repo)
    {

        $user = $repo->find(1);

        return $this->render('home.html.twig', [
            'user' => $user 
        ]);
    }

}
