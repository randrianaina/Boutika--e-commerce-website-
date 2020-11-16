<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

//PROBLEME 1 : utilisation de l'objet User impossible sur un contrôlleur de Form 
    //SOLUTION 1-1: intégration du service Security par use Symfony\Component\Security\Core\Security
use Symfony\Component\Security\Core\Security;

use App\Entity\AdresseLivraison;
use App\Repository\AdresseLivraisonRepository;


class SelectAdresseLivraisonType extends AbstractType
{
    //SOLUTION 1-2 : déclaration d'une propriété de class $security
    private $security;
    //SOLUTION 1-3 : intégration d'un constructeur utilisant le service Security
    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresselivraison', EntityType::class, [
                
                'class' => AdresseLivraison::class,
                'multiple' => false,
                'expanded' => true,
                "label_attr" => ["class" => "radio-custom"],
                'choice_label' => function (AdresseLivraison $adresse_livraison){
                    return sprintf (' %s %s %s %d %s ', $adresse_livraison->getNomContact(), 
                    $adresse_livraison->getPrenomContact(), $adresse_livraison->getAdresseContact(),
                    $adresse_livraison->getCpContact(), $adresse_livraison->getVilleContact());
                },
                'placeholder' => 'Veuillez sélectionner une adresse de livraison',
                'query_builder' => function (AdresseLivraisonRepository $er){
                    return $er->createQueryBuilder('adresselivraison')
                    ->andWhere('adresselivraison.id_utilisateur = :user_id')
                    ->setParameter('user_id', $this->security->getUser());
                }

            ])   
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
/*             'data_class' => AdresseLivraison::class,
 */        ]);
    }
}
