<?php

namespace App\Repository;

use App\Entity\Screen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Screen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Screen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Screen[]    findAll()
 * @method Screen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScreenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Screen::class);
    }


    /**
     * @param $value
     * @return Screen|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function fetchFullTree($value): ?Screen
    {
        $qb = $this->createQueryBuilder('s')
            ->addSelect('d')
            ->addSelect('shd')
            ->addSelect('dhs')
            ->addSelect('sl')
        ;

        $qb->leftJoin('s.screenHasDecks', 'shd')
            ->leftJoin('shd.deck', 'd')
            ->leftJoin('d.deckHasSlides', 'dhs')
            ->leftJoin('dhs.slide', 'sl')
        ;

        $qb->andWhere('s.id = :screenId')
            ->andWhere('shd.enable = true')
            ->andWhere('dhs.enable = true')
        ;

        $qb->addOrderBy('shd.position', 'ASC')
            ->addOrderBy('dhs.position', 'ASC')
        ;

        return $qb->setParameter('screenId', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }



//    /**
//     * @return Screen[] Returns an array of Screen objects
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
    public function findOneBySomeField($value): ?Screen
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
