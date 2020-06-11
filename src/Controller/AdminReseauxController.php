<?php

namespace App\Controller;

use App\Entity\Reseaux;
use App\Form\ReseauxType;
use App\Repository\ReseauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminReseauxController extends AbstractController
{
    /**
     * @Route("/admin/reseaux/index", name="admin_reseaux_index")
     */
    public function index(ReseauxRepository $repo)
    {
        $reseaux = $repo->findAll();

        return $this->render('admin/reseaux/index.html.twig', [
            'reseaux' => $reseaux,
        ]);
    }

     /**
     * Pour ajouter un réseau
     *
     * @Route("/admin/reseaux/create", name="admin_reseaux_create")
     * 
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $reseaux = new Reseaux();

        $form = $this->createForm(ReseauxType::class, $reseaux);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        
            // $ad->setAuthor($this->getUser());
            // $ad->setUpdatedAt(new \DateTime('now'));
            // $ad->initializeSlug();
            $manager->persist($reseaux);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong> {$reseaux->getTitle()}</strong> a bien été enregistrer !"
            );

            return $this->redirectToRoute('admin_reseaux_index');
        }

        return $this->render('admin/reseaux/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

        /**
     * Modifier les réseaux
     * 
     * @Route("/admin/reseaux/{id}/edit", name="admin_reseaux_edit")
     *
     * @param reseaux $reseaux
     * @param Request $request
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function edit(reseaux $reseaux, Request $request, EntityManagerInterface $manager)
    {

        $form = $this->createForm(reseauxType::class, $reseaux);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($reseaux);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications ont bien étés prises en comptes"
            );
        }

        return $this->render('admin/reseaux/edit.html.twig', [
            'reseaux' => $reseaux,
            'form' => $form->createView()
        ]);
    }

     /**
     * Supprimer un réseau
     * 
     * @Route("/admin/reseaux/{id}/delete", name="admin_reseaux_delete")
     *
     * @param reseaux $reseaux
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(reseaux $reseaux, EntityManagerInterface $manager)
    {

            $manager->remove($reseaux);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$reseaux->getTitle()}</strong> a bien été supprimé"
            );

        return $this->redirectToRoute("admin_reseaux_index");
    }

}
