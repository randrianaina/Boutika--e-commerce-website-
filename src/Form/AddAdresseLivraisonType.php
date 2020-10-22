<?php

namespace App\Form;

use App\Entity\AdresseLivraison;
use App\Repository\AdresseLivraisonRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Security;


class AddAdresseLivraisonType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dd($this->security->getUser()->getId());
        $builder
           
            ->add('nom_contact', TextType::class)
            ->add('prenom_contact', TextType::class)
            ->add('adresse_contact', TextType::class)
            ->add('cp_contact', TextType::class)
            ->add('ville_contact', TextType::class)
            ->add('id_utilisateur', HiddenType::class,['empty_data' => $this->security->getUser()/* ->getId() */,])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdresseLivraison::class,
        ]);
    }
}
