<?php

namespace App\Repository;

use App\Entity\Scoreboard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Scoreboard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scoreboard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scoreboard[]    findAll()
 * @method Scoreboard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreboardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Scoreboard::class);
    }

//    /**
//     * @return Scoreboard[] Returns an array of Scoreboard objects
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
    public function findOneBySomeField($value): ?Scoreboard
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
