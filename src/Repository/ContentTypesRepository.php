<?php

namespace App\Repository;

use App\Entity\ContentTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContentTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContentTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContentTypes[]    findAll()
 * @method ContentTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContentTypes::class);
    }

    // /**
    //  * @return ContentTypes[] Returns an array of ContentTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContentTypes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
