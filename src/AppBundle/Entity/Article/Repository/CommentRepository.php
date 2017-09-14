<?php

namespace AppBundle\Entity\Article\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CommentRepository
 * @package AppBundle\Entity\Article\Repository
 */
class CommentRepository extends EntityRepository
{
        public function findByTerm($string) {

        }
}