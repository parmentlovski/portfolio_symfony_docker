<?php

namespace App\Form;

use App\Entity\Projet;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjetType extends  ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, $this->getConfiguration("Titre du projet", "The projet"))
        ->add('description', TextType::class, $this->getConfiguration("Decription du projet", "Description projet"))
        ->add('url', TextType::class, $this->getConfiguration("Url du projet", "Url projet"))
        ->add('avis', TextType::class, $this->getConfiguration("Avis du client", "Avis client"))
        ->add('imageFile', FileType::class, $this->getConfiguration("Importer le logo du projet", "Choisir un fichier de votre PC", [
            'required' => false
        ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
