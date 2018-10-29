<?php

namespace App\Repository;

use App\Entity\ScreenHasDeck;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ScreenHasDeck|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScreenHasDeck|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScreenHasDeck[]    findAll()
 * @method ScreenHasDeck[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScreenHasDeckRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ScreenHasDeck::class);
    }

//    /**
//     * @return ScreenHasDeck[] Returns an array of ScreenHasDeck objects
//     */
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
    public function findOneBySomeField($value): ?ScreenHasDeck
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
