<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article\Article;
use AppBundle\Form\Type\Front\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ArticleController
 *
 * @package AppBundle\Controller\Front
 */
class ArticleController extends Controller
{
    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articlesAction(Request $request, EntityManagerInterface $entityManager)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($article);
                $entityManager->flush();
            }
        }

        $articles = $entityManager->getRepository(Article::class)->findAll();

        return $this->render(':front:articles.html.twig', array(
            'form' => $form->createView(),
            'articles' => $articles
        ));
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param                        $ArticleId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function articleAction(EntityManagerInterface $entityManager, $articleId)
    {
        $article = $entityManager->getRepository(Article::class)->find($articleId);

        return $this->render(':front:article.html.twig', array(
            'article' => $article
        ));
    }

}
