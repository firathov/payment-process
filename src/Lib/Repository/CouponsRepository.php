<?php

namespace Lib\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lib\Entity\Coupons;

/**
 * @extends ServiceEntityRepository<Coupons>
 *
 * @method Coupons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coupons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coupons[]    findAll()
 * @method Coupons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouponsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupons::class);
    }
}
