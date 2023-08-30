<?php

namespace Lib\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lib\Entity\CountryTaxes;

/**
 * @extends ServiceEntityRepository<CountryTaxes>
 *
 * @method CountryTaxes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CountryTaxes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CountryTaxes[]    findAll()
 * @method CountryTaxes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryTaxesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CountryTaxes::class);
    }
}
