<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use AppBundle\Entity\Article\Comment;
use AppBundle\Entity\Article\Tag;
use AppBundle\Form\Type\Article\ArticleType;
use AppBundle\Form\Type\Article\CommentType;
use Beta\A;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @return                       Response
     */
    public function indexAction(Request $request, EntityManagerInterface $entityManager)
    {
        $articles = $entityManager->getRepository(Article::class)->findAll();

        return $this->render(':back/article:index.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @return                       Response
     */
    public function newAction(Request $request, EntityManagerInterface $entityManager)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('back_article_index'));
            }
        }

        return $this->render(':back/article:new.html.twig', array(
            'form' => $form->createView()
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
        $article = $entityManager->getRepository(Article::class)->find($articleId);

        $comments = $entityManager->getRepository(Comment::class)->findByArticleForAdmin($article);

        return $this->render(':back/article:show.html.twig', array(
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
                $currentTags = new ArrayCollection();

                foreach ($article->getTags() as $tag) {
                    $tagDb = $entityManager->getRepository(Tag::class)->findOneByName($tag->getName());

                    if ($tagDb) {
                        $currentTags->add($tagDb);
                    } else {
                        $entityManager->persist($tag);

                        $currentTags->add($tag);
                    }
                }

                $article->setTags($currentTags);

                $entityManager->persist($article);
                $entityManager->flush();
            }
        }

        return $this->render(':back/article:update.html.twig', array(
            'form' => $form->createView(),
            'article' => $article,
        ));
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param $articleId
     * @return JsonResponse
     */
    public function updateActiveAction(EntityManagerInterface $entityManager, $articleId)
    {
        $article = $entityManager->getRepository(Article::class)->find($articleId);

        $active = $article->getActive();

        $response = new JsonResponse();

        return $response->setData(array(
            'active' => $active,
        ));
    }
}
