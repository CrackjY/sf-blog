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
    public function findByCategoryId($categoryId)
    {
        return $this
            ->createQueryBuilder('a')
            ->innerJoin('a.categories', 'ca')
            ->where('ca.id = :categoryId')
            ->andWhere('a.active = :active')
            ->orderBy('a.date', 'DESC')
            ->setParameter(':categoryId', $categoryId)
            ->setParameter(':active', true)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $term
     * @return array
     */
    public function findByTerm($term)
    {
        $queryBuilder = $this
            ->createQueryBuilder('a')
            ->where('a.content LIKE :term')
            ->setParameter(':term', '%' . $term . '%');

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }


}