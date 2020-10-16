<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Details_Utilisateurs_Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite_utilisateur')
            ->add('nom_utilisateur')
            ->add('prenom_utilisateur')
            ->add('adresse_utilisateur')
            ->add('cp_utilisateur')
            ->add('ville_utilisateur')
            ;
    }
    public function configureOptions (OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                ‘data_class’ =>Utilisateurs::class
                //binds the Form data to a Class; activates the FormType guessing system
            ]);
        }
}


    