<?php

namespace App\Repository;

use App\Entity\Importance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Importance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Importance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Importance[]    findAll()
 * @method Importance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Importance::class);
    }

    // /**
    //  * @return Importance[] Returns an array of Importance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Importance
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
