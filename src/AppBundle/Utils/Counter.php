<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Counter
 * @package AppBundle\Utils
 */
class Counter
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function countByCategory($categoryId)
    {
        return $this
            ->createQueryBuilder('a')
            ->select('count(a.id)')
            ->innerJoin('a.categories', 'ca')
            ->where('ca.id = :categoryId')
            ->setParameter(':categoryId', $categoryId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}