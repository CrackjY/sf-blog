<?php

namespace AppBundle\Entity\Article\Repository;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findByActive()
    {
        $queryBuilder = $this
            ->createQueryBuilder('a')
            ->Where('a.active = 1')
            ->orderBy('a.date', 'DESC');

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $categoryId
     * @return array
     */
    public function findByCategoryId($categoryId, $active)
    {
        $queryBuilder = $this
            ->createQueryBuilder('a')
            ->innerJoin('a.categories', 'ca')
            ->innerJoin('ca.articles', 'c')
            ->where('ca = :ca')
            ->andWhere('a.active = :active')
            ->orderBy('a.date', 'DESC')
            ->setParameter(':ca', $categoryId)
            ->setParameter(':active', $active);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}