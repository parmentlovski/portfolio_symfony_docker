<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class, $this->getConfiguration("Email", "@"))
        ->add('slogan', TextType::class, $this->getConfiguration("Slogan", "The slogan"))
        ->add('description', TextareaType::class, $this->getConfiguration("Description", "Description qui donne envie"))
        ->add('accroche', TextareaType::class, $this->getConfiguration("Accroche", "Seo Friendly"))
        ->add('imageFile', FileType::class, $this->getConfiguration("Importer l'image principale", "Choisir un fichier de votre PC", [
            'required' => false
        ]));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
