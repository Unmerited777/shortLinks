<?php

namespace App\Repository;

use App\Entity\RedirectCounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RedirectCounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method RedirectCounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method RedirectCounter[]    findAll()
 * @method RedirectCounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RedirectCounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RedirectCounter::class);
    }

    // /**
    //  * @return RedirectCounter[] Returns an array of RedirectCounter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RedirectCounter
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
