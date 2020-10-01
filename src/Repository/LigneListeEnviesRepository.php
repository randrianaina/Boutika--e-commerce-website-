<?php

namespace App\Repository;

use App\Entity\LigneListeEnvies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LigneListeEnvies|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneListeEnvies|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneListeEnvies[]    findAll()
 * @method LigneListeEnvies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneListeEnviesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneListeEnvies::class);
    }

    // /**
    //  * @return LigneListeEnvies[] Returns an array of LigneListeEnvies objects
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
    public function findOneBySomeField($value): ?LigneListeEnvies
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
