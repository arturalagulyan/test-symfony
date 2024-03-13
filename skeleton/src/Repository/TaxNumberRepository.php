<?php

namespace App\Repository;

use App\Entity\TaxNumber;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends BaseRepository<TaxNumber>
 *
 * @method TaxNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxNumber[]    findAll()
 * @method TaxNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxNumberRepository extends BaseRepository
{
    /**
     * TaxNumberRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxNumber::class);
    }
}
