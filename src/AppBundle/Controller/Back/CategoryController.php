<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use AppBundle\Form\Type\Article\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 *
 * @package AppBundle\Controller\Back
 */
class CategoryController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(EntityManagerInterface $entityManager)
    {
        $categories = $entityManager->getRepository(Category::class)->findAll();

        return $this->render(':back/category:index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function newAction(Request $request, EntityManagerInterface $entityManager)
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($category);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('back_category_index'));
            }
        }

        return $this->render(':back/category:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function showAction(Request $request, EntityManagerInterface $entityManager, $categoryId)
    {
        $category = $entityManager->getRepository(Category::class)->find($categoryId);

        $articles = $entityManager->getRepository(Article::class)->findByCategoryId($category);

        $countArticle = count($articles);

        return $this->render(':back/category:show.html.twig', array(
            'category' => $category,
            'countArticle' => $countArticle,
        ));
    }
}
