<?php

namespace App\Repository;

use App\Entity\DeckHasSlide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DeckHasSlide|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeckHasSlide|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeckHasSlide[]    findAll()
 * @method DeckHasSlide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeckHasSlideRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DeckHasSlide::class);
    }

//    /**
//     * @return DeckHasSlide[] Returns an array of DeckHasSlide objects
//     */
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
    public function findOneBySomeField($value): ?DeckHasSlide
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
