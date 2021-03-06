<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Comment;
use AppBundle\Form\Type\Article\ArticleType;
use AppBundle\Form\Type\Article\CommentType;
use AppBundle\Utils\Counter;
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
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param Counter $counter
     * @param $articleId
     * @return Response
     */
    public function showAction(Request $request, EntityManagerInterface $entityManager, Counter $counter, $articleId)
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

        $comments = $entityManager->getRepository(Comment::class)->findByArticle($article);

        //$nbComments = $entityManager->getRepository(Comment::class)->countByArticle($article);

        $nbComments = $counter->count(Comment::class, 'byArticle', $article);

        return $this->render(':front:article.html.twig', array(
            'form' => $form->createView(),
            'article' => $article,
            'comments' => $comments,
            'nbComments' => $nbComments,
        ));
    }
}
