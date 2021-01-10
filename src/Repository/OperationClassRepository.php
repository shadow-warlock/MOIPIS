<?php

namespace App\Repository;

use App\Entity\OperationClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationClass[]    findAll()
 * @method OperationClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationClass::class);
    }

    // /**
    //  * @return OperationClass[] Returns an array of OperationClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationClass
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
