<?php

namespace App\Form;

use App\Entity\AdresseLivraison;
use App\Repository\AdresseLivraisonRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class InfoAdresseLivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_contact', TextType::class)
            ->add('prenom_contact', TextType::class)
            ->add('adresse_contact', TextType::class)
            ->add('cp_contact', TextType::class)
            ->add('ville_contact', TextType::class)
            ->add('Enregistrer', SubmitType::class, ['label' => 'Enregistrer vos modifications'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdresseLivraison::class,
        ]);
    }
}
