<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminServiceController extends AbstractController
{
    /**
     * @Route("/admin/services/index", name="admin_services_index")
     */
    public function index(ServiceRepository $repo)
    {
        $services = $repo->findAll();

        return $this->render('admin/service/index.html.twig', [
            'services' => $services,
        ]);
    }

     /**
     * Pour ajouter un service
     *
     * @Route("/admin/services/create", name="admin_services_create")
     * 
     * 
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $service = new Service();

        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        
            // $ad->setAuthor($this->getUser());
            // $ad->setUpdatedAt(new \DateTime('now'));
            // $ad->initializeSlug();
            $manager->persist($service);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong> {$service->getTitle()}</strong> a bien été enregistrer !"
            );

            return $this->redirectToRoute('admin_services_index');
        }

        return $this->render('admin/service/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

        /**
     * Modifier les réseaux
     * 
     * @Route("/admin/services/{id}/edit", name="admin_services_edit")
     *
     * @param service $service
     * @param Request $request
     * @param EntityManagerInterface $manager
     * 
     * @return Response
     */
    public function edit(service $service, Request $request, EntityManagerInterface $manager)
    {

        $form = $this->createForm(ServiceType::class, $service);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($service);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications ont bien étés prises en comptes"
            );
        }

        return $this->render('admin/service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView()
        ]);
    }

     /**
     * Supprimer un réseau
     * 
     * @Route("/admin/service/{id}/delete", name="admin_services_delete")
     *
     * @param service $service
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(service $service, EntityManagerInterface $manager)
    {

            $manager->remove($service);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$service->getTitle()}</strong> a bien été supprimé"
            );

        return $this->redirectToRoute("admin_services_index");
    }

}
