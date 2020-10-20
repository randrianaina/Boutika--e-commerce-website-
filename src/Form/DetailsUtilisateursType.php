<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DetailsUtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite_utilisateur', TextType::class)
            ->add('nom_utilisateur', TextType::class)
            ->add('prenom_utilisateur', TextType::class)
            ->add('adresse_utilisateur', TextType::class)
            ->add('cp_utilisateur', TextType::class)
            ->add('ville_utilisateur' , TextType::class)
            ->add('Enregistrer', SubmitType::class, ['label' => 'Enregistrer vos modifications'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
