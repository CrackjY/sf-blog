<?php

namespace AppBundle\Utils;

use AppBundle\Entity\Article\Article;
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
     * @param $value
     * @return mixed
     */
    public function count($value)
    {
        return $this->entityManager->getRepository(Article::class)->countByCategory($value);
    }
}