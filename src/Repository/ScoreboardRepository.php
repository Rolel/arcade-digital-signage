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

    public function getByGameType($gameTypeId)
    {
        $qb = $this->createQueryBuilder('sb')
            ->innerJoin('sb.game', 'g')
            ->andWhere('g.category = :gameTypeId')
            ->setParameter('gameTypeId', $gameTypeId)
        ;

        return $qb->getQuery()->getResult();
    }

    public function getTop($scoreBoardId, $number = 10, $field = 'value', $direction = 'DESC')
    {
        $qb = $this->createQueryBuilder('sb')
            ->addSelect('s')
            ->addSelect('g')
            ->addSelect('b')
        ;

        $qb->innerJoin('s.scores', 's')
            ->leftJoin('sb.game', 'g')
            ->leftJoin('g.brand', 'b')
        ;

        $qb->andWhere('sb.id = :scoreBoardId');

        $qb->setParameter('scoreBoardId', $scoreBoardId)
            ->orderBy('s.'.$field, $direction)
        ;

        return $qb->getQuery()
            ->setMaxResults($number)
            ->getOneOrNullResult();
    }
}
