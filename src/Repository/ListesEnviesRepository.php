<?php

namespace App\Repository;

use App\Entity\ListesEnvies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListesEnvies|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListesEnvies|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListesEnvies[]    findAll()
 * @method ListesEnvies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListesEnviesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListesEnvies::class);
    }

    // /**
    //  * @return ListesEnvies[] Returns an array of ListesEnvies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListesEnvies
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
