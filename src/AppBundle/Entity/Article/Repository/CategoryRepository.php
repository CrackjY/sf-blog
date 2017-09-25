<?php

namespace AppBundle\Entity\Article\Repository;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    /**
     * @return array
     */
        public function findByActive()
    {
        $queryBuilder = $this
            ->createQueryBuilder('ca')
            ->Where('ca.active = 1')
            ->orderBy('ca.name', 'ASC');

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }
}
