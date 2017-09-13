<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Comment;
use AppBundle\Form\Type\Front\ArticleType;
use AppBundle\Form\Type\Front\CommentsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

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
     * @return Response
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
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @param                        $articleId
     * @return                       Response
     */
    public function articleAction(Request $request, EntityManagerInterface $entityManager, $articleId)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentsType::class, $comment);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($comment);
                $entityManager->flush();

                $comment->setArticle($articleId);
            }
        }

        $article = $entityManager->getRepository(Article::class)->find($articleId);

        return $this->render(':front:article.html.twig', array(
            '$form' => $form->createView(),
            'article' => $article
        ));
    }
}
