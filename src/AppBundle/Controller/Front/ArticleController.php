<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Comment;
use AppBundle\Form\Type\Front\ArticleType;
use AppBundle\Form\Type\Front\CommentType;
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
                dump($comment);
                die();
                $entityManager->persist($comment);
                $entityManager->flush();
            }
        }

        return $this->render(':front:article.html.twig', array(
            'form' => $form->createView(),
            'article' => $article
        ));
    }
}
