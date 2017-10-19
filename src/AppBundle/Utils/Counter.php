<?php

namespace AppBundle\Utils;

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
     * @param $categoryId
     * @return mixed
     */
    public function count($categoryId)
    {
    }
}