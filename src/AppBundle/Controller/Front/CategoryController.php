<?php

namespace AppBundle\Controller\Front;


use AppBundle\Test\Test;
use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use AppBundle\Form\Type\Article\CategoryType;
use AppBundle\Form\Type\Article\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 * @package AppBundle\Controller\Front
 */
class CategoryController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param                        $categoryId
     * @return                       Response
     */
    public function showAction(EntityManagerInterface $entityManager, $categoryId)
    {
        $test = new Test();

        $articles = $entityManager->getRepository(Article::class)->findByCategoryId($categoryId);

        $countArticle = $test->count($articles);

        return $this->render(':front:category.html.twig', array(
            'countArticle' => $countArticle,
            'articles' => $articles,
        ));
    }
}
