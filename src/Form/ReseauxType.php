<?php

namespace App\Form;

use App\Entity\Reseaux;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReseauxType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre du réseau", "The réseau"))
            ->add('url', TextType::class, $this->getConfiguration("Url du réseau", "Url réseau"))
            ->add('imageFile', FileType::class, $this->getConfiguration("Importer le logo du réseau", "Choisir un fichier de votre PC", [
                'required' => false
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reseaux::class,
        ]);
    }
}
