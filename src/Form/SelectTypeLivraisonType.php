<?php

namespace App\Form;

use App\Entity\TypesLivraison;
use App\Repository\TypesLivraisonRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class SelectTypeLivraisonType extends AbstractType
{   
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_livraison', EntityType::class, [
                'class' => TypesLivraison::class,
                'multiple' => false,
                'expanded' => true,
                'placeholder' => 'Veuillez sélectionner un type de livraison',
                'choice_label' => function (TypesLivraison $type_livraison){
                    //PROBLEME : affichage des chiffres sans virgules - SOLUTION : utilisation du spéficateur %.2f au lieu de %d sur la fonction sprintf
                    return sprintf (' %s %s jours %.2f € ', $type_livraison->getLibelleLivraison(), 
                    $type_livraison->getDelaiLivraison(), $type_livraison->getFraisLivraison());
                },
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            /* 'data_class' => TypesLivraison::class, */
        ]);
    }
}
