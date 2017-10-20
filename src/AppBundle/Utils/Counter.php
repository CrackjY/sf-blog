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

    /**
     * Counter constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $repository
     * @param $value
     * @return mixed
     */
    public function count($repository, $value)
    {
         return $this->entityManager->getRepository($repository)->countByCategory($value);
    }
}