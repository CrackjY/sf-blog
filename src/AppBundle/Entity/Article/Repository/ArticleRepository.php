<?php

namespace AppBundle\Entity\Article\Repository;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use AppBundle\Form\Model\SearchModel;
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
        return $this
            ->createQueryBuilder('a')
            ->Where('a.active = :active')
            ->orderBy('a.date', 'DESC')
            ->setParameter(':active', true)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function findByRecent()
    {
        return $this
            ->createQueryBuilder('a')
            ->Where('a.active = :active')
            ->orderBy('a.date', 'DESC')
            ->setParameter(':active', true)
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findInactives()
    {
        return $this
            ->createQueryBuilder('a')
            ->Where('a.active = :active')
            ->orderBy('a.date', 'DESC')
            ->setParameter(':active', false)
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
     * @param $categoryId
     * @return array
     */
    public function findByCategoryIdForAdmin($categoryId)
    {
        return $this
            ->createQueryBuilder('a')
            ->innerJoin('a.categories', 'ca')
            ->where('ca.id = :categoryId')
            ->orderBy('a.date', 'DESC')
            ->setParameter(':categoryId', $categoryId)
            ->getQuery()
            ->getResult();
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

    /**
     * @param SearchModel $searchModel
     * @return array
     */
    public function findBySearch(SearchModel $searchModel)
    {
        $queryBuilder = $this
            ->createQueryBuilder('a')
            ->innerJoin('a.categories', 'ca')
            ->where('a.active = :active')
            ->setParameter(':active', true);

        if ($searchModel->getCategories()->count()) {
            $queryBuilder
                ->andWhere('ca.id IN(:categories)')
                ->setParameter(':categories', $searchModel->getCategories());
        }

        if ($searchModel->getTerm()) {
            $queryBuilder
                ->andwhere('a.content LIKE :term')
                ->setParameter(':term', '%' . $searchModel->getTerm() . '%');
        }

        if ($searchModel->getStartDate() && $searchModel->getEndDate()) {
            $queryBuilder
                ->andWhere('a.date BETWEEN :dateStart AND :dateEnd')
                ->setParameter(':dateStart', $searchModel->getStartDate())
                ->setParameter(':dateEnd', $searchModel->getEndDate());
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
