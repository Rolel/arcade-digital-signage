<?php

namespace App\Repository;

use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Score|null find($id, $lockMode = null, $lockVersion = null)
 * @method Score|null findOneBy(array $criteria, array $orderBy = null)
 * @method Score[]    findAll()
 * @method Score[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Score::class);
    }

    public function getTop($scoreBoardId, $number = 10, $field = 'value', $direction = 'DESC')
    {
        $qb = $this->createQueryBuilder('s')
            ->addSelect('sb')
            ->addSelect('g')
            ->addSelect('b')
        ;

        $qb->innerJoin('s.scoreboard', 'sb')
            ->leftJoin('sb.game', 'g')
            ->leftJoin('g.brand', 'b')
        ;

        $qb->andWhere('sb.id = :scoreBoardId');

        $qb->setParameter('scoreBoardId', $scoreBoardId)
            ->orderBy('s.'.$field, $direction)
        ;

        return $qb->getQuery()
            ->setMaxResults($number)
            ->getResult();
    }

//    /**
//     * @return Score[] Returns an array of Score objects
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
    public function findOneBySomeField($value): ?Score
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
