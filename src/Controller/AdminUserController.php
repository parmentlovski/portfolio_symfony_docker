<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    /**
     *  
     * Affiche mes informations 
     * 
     * @Route("/admin/user", name="admin_user")
     *
     * @return Response
     */
    public function index(UserRepository $repo)
    {

        $users = $repo->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users 
        ]);
    }

      /**
     * Permet de modifier mes informations
     * 
     * @Route("/admin/user/{id}/edit", name="admin_edit")
     *
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function edit(User $user, Request $request, EntityManagerInterface $manager)
    {

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications ont bien étés prises en comptes"
            );
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
