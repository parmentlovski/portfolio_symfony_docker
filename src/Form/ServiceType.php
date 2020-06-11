<?php

namespace App\Form;

use App\Entity\Service;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ServiceType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, $this->getConfiguration("Titre du service", "The service"))
        ->add('description', TextType::class, $this->getConfiguration("Description du service", "Description service"))
        ->add('imageFile', FileType::class, $this->getConfiguration("Importer le logo du service", "Choisir un fichier de votre PC", [
            'required' => false
        ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
