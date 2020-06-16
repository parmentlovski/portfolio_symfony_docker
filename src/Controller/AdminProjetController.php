<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProjetController extends AbstractController
{
    /**
     * Affiche la page destiné aux projets
     * 
     * @Route("/admin/projet/index", name="admin_projet_index")
     */
    public function index(ProjetRepository $projetRepo)
    {
        $projets = $projetRepo->findAll();
        

        return $this->render('admin/projet/index.html.twig', [
            'projets' => $projets,
        ]);
    }

     /**
     * Pour ajouter un projet
     *
     * @Route("/admin/projet/create", name="admin_projet_create")
     * 
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $projet = new Projet();

        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($projet);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong> {$projet->getTitle()}</strong> a bien été enregistrer !"
            );

            return $this->redirectToRoute('admin_projet_index');
        }

        return $this->render('admin/projet/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

      /**
     * Modifier les réseaux
     * 
     * @Route("/admin/projet/{id}/edit", name="admin_projet_edit")
     *
     * @param projet $projet
     * @param Request $request
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function edit(projet $projet, Request $request, EntityManagerInterface $manager)
    {

        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($projet);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications ont bien étés prises en comptes"
            );
        }

        return $this->render('admin/projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form->createView()
        ]);
    }

    /**
     * Supprimer un projet
     * 
     * @Route("/admin/projet/{id}/delete", name="admin_projet_delete")
     *
     * @param projet $projet
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(projet $projet, EntityManagerInterface $manager)
    {

            $manager->remove($projet);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$projet->getTitle()}</strong> a bien été supprimé"
            );

        return $this->redirectToRoute("admin_projet_index");
    }

}
