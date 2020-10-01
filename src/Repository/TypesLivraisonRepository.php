<?php

namespace App\Repository;

use App\Entity\TypesLivraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypesLivraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypesLivraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypesLivraison[]    findAll()
 * @method TypesLivraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypesLivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypesLivraison::class);
    }

    // /**
    //  * @return TypesLivraison[] Returns an array of TypesLivraison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypesLivraison
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
