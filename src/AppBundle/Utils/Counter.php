<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Article\Repository\ArticleRepository;

/**
 * Class Counter
 * @package AppBundle\Utils
 */
class Counter extends ArticleRepository
{
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