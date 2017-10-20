<?php

namespace AppBundle\Controller\Front;

use AppBundle\Utils\Counter;
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
     * @param Counter $counter
     * @param $categoryId
     * @return Response
     */
    public function showAction(EntityManagerInterface $entityManager, Counter $counter, $categoryId)
    {
        $category = $entityManager->getRepository(Category::class)->find($categoryId);

        $articles = $entityManager->getRepository(Article::class)->findByCategoryId($categoryId);

        $nbArticles = $counter->count(Article::class, $category);

        return $this->render(':front:category.html.twig', array(
            'nbArticles' => $nbArticles,
            'articles' => $articles,
        ));
    }
}
