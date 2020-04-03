<?php

namespace App\Repository;

use App\Entity\CardType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Cache\Adapter\AdapterInterface;

/**
 * @method CardType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CardType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CardType[]    findAll()
 * @method CardType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardTypeRepository extends ServiceEntityRepository
{
    /**
     * @var AdapterInterface
     */
    private $cache;

    public function __construct(ManagerRegistry $registry, AdapterInterface $cache)
    {
        parent::__construct($registry, CardType::class);

        $this->cache = $cache;
    }

    /**
     * @param $name
     * @return CardType[]
     */
    public function findByName($name): array
    {
        $item = $this->cache->getItem('cardTypesByExample' . md5($name));
        if (!$item->isHit()) {
            $result = $this->createQueryBuilder('c')
                ->andWhere('c.name = :val')
                ->setParameter('val', $name)
//                ->orderBy('c.id', 'ASC')
//                ->setMaxResults(10)
                ->getQuery()
                ->getResult();

            $item->set($result);
            $this->cache->save($item);
        }

        return $item->get();
    }

    /*
    public function findOneBySomeField($value): ?CardType
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
