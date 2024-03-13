<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class BaseService
 * @package App\Services
 */
abstract class BaseService
{
    /**
     * ProductService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(protected EntityManagerInterface $entityManager)
    {

    }
}