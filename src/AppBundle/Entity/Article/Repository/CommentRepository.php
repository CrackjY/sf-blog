<?php

namespace AppBundle\Entity\Article\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CommentRepository
 * @package AppBundle\Entity\Article\Repository
 */
class CommentRepository extends EntityRepository
{
    /**
     * @param $term
     */
    public function findByTerm($term)
    {
        return true;
    }
}