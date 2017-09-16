<?php

namespace AppBundle\Entity\Article\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
    /**
     * @param $term
     * @param null $limit
     * @return array
     */
    public function findByTerm($term, $limit = null)
    {
        $queryBuilder = $this
        	->createQueryBuilder('co')
            ->where('co.content LIKE :term')
            ->setParameter(':term', '%' . $term . '%');

        if ($limit) {
            $queryBuilder->setMaxResults($limit);
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $article
     * @return array
     */
    public function findByArticle($article)
    {
        $queryBuilder = $this
            ->createQueryBuilder('co')
            ->where('co.article = :article')
            ->andWhere('co.active = 1')
            ->orderBy('co.date', 'DESC')
            ->setParameter(':article', $article);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $article
     * @return array
     */
    public function findByArticleForAdmin($article)
    {
        $queryBuilder = $this
            ->createQueryBuilder('co')
            ->where('co.article = :article')
            ->orderBy('co.date', 'DESC')
            ->setParameter(':article', $article);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}