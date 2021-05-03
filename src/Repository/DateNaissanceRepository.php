<?php

namespace App\Repository;

use App\Entity\DateNaissance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DateNaissance|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateNaissance|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateNaissance[]    findAll()
 * @method DateNaissance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateNaissanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateNaissance::class);
    }

    // /**
    //  * @return DateNaissance[] Returns an array of DateNaissance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateNaissance
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
