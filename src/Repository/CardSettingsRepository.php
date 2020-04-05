<?php

namespace App\Repository;

use App\Entity\CardSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CardSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardSettings[]    findAll()
 * @method CardSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CardSettings::class);
    }

    // /**
    //  * @return CardSettings[] Returns an array of CardSettings objects
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
    public function findOneBySomeField($value): ?CardSettings
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
