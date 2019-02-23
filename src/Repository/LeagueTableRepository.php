<?php

namespace App\Repository;

use App\Entity\LeagueTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LeagueTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeagueTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeagueTable[]    findAll()
 * @method LeagueTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeagueTableRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LeagueTable::class);
    }

    // /**
    //  * @return LeagueTable[] Returns an array of LeagueTable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LeagueTable
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
