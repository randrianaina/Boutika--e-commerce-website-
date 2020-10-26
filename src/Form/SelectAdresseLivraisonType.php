<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\AdresseLivraison;
use App\Repository\AdresseLivraisonRepository;


class SelectAdresseLivraisonType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse_livraison', EntityType::class, [
                'class' => AdresseLivraison::class,
                'multiple' => false,
                'expanded' => true,
                'choice_label' => function (AdresseLivraison $adresse_livraison){
                    return sprintf ("'%s %s %s %d %s'\r\n", $adresse_livraison->getNomContact(), 
                    $adresse_livraison->getPrenomContact(), $adresse_livraison->getAdresseContact(),
                    $adresse_livraison->getCpContact(), $adresse_livraison->getVilleContact(), '\r\n');
                    sprintf ("'%s %s %s %d %s'\r\n", $adresse_livraison->getNomContact(), 
                    $adresse_livraison->getPrenomContact(), $adresse_livraison->getAdresseContact(),
                    $adresse_livraison->getCpContact(), $adresse_livraison->getVilleContact(), '\r\n');
                },
                'placeholder' => 'Veuillez sélectionner une adresse de livraison',
                'query_builder' => function (AdresseLivraisonRepository $er){
                    return $er->createQueryBuilder('adresse_livraison')
                    ->andWhere('adresse_livraison.id_utilisateur = :user_id')
                    ->setParameter('user_id', $this->security->getUser());
                }

            ])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdresseLivraison::class,
        ]);
    }
}
