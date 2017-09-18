<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Comment;
use AppBundle\Form\Type\Article\ArticleType;
use AppBundle\Form\Type\Article\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 *
 * @package AppBundle\Controller\Back
 */
class ArticleController extends Controller
{
    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function indexAction(Request $request, EntityManagerInterface $entityManager)
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

        $articles = $entityManager->getRepository(Article::class)->findByActive($article);

        return $this->render(':back/article:index.html.twig', array(
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
    public function showAction(Request $request, EntityManagerInterface $entityManager, $articleId)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $article = $entityManager->getRepository(Article::class)->find($articleId);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $comment->setArticle($article);

                $entityManager->persist($comment);
                $entityManager->flush();
            }
        }

        $comments = $entityManager->getRepository(Comment::class)->findByArticleForAdmin($article);

        return $this->render(':back/article:show.html.twig', array(
            'form' => $form->createView(),
            'article' => $article,
            'comments' => $comments
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param                        $articleId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, EntityManagerInterface $entityManager, $articleId)
    {
        $article = $entityManager->getRepository(Article::class)->find($articleId);

        $form = $this->createForm(ArticleType::class, $article);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('back_admin_list_articles'));
            }
        }

        return $this->render(':back/article:update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
