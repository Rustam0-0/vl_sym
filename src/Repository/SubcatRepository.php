<?php

namespace App\Repository;

use App\Entity\Subcat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subcat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subcat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subcat[]    findAll()
 * @method Subcat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubcatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subcat::class);
    }

    // /**
    //  * @return Subcat[] Returns an array of Subcat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subcat
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
