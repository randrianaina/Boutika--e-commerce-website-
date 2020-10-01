<?php

namespace App\Repository;

use App\Entity\ListeEnvies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ListeEnvies|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListeEnvies|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListeEnvies[]    findAll()
 * @method ListeEnvies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListeEnviesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListeEnvies::class);
    }

    // /**
    //  * @return ListeEnvies[] Returns an array of ListeEnvies objects
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
    public function findOneBySomeField($value): ?ListeEnvies
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
