<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DetailsUtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite_utilisateur', ChoiceType::class, ['choices'  => [
                'Monsieur' =>'Mr',
                'Madame' => 'Mme'
            ],
        ])
            ->add('nom_utilisateur', TextType::class, [
                'required' => true])
            ->add('prenom_utilisateur', TextType::class, [
                'required' => true])
            ->add('adresse_utilisateur', TextType::class, [
                'required' => true])
            ->add('cp_utilisateur', TextType::class, [
                'required' => true])
            ->add('ville_utilisateur' , TextType::class, [
                'required' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
