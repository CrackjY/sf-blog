<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\Article\Comment;
use AppBundle\Form\Type\Article\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CommentController
 *
 * @package AppBundle\Controller\Back
 */
class CommentController extends Controller
{
    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @param                        $commentId
     * @return                       Response
     */
    public function showAction(Request $request, EntityManagerInterface $entityManager, $commentId)
    {
        $comment = $entityManager->getRepository(Comment::class)->find($commentId);

        return $this->render(':back/comment:show.html.twig', array(
            'comment' => $comment
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param                        $commentId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, EntityManagerInterface $entityManager, $commentId)
    {
        $comment = $entityManager->getRepository(Comment::class)->find($commentId);

        $form = $this->createForm(CommentType::class, $comment);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($comment);
                $entityManager->flush();

                return $this->redirect($this->generateUrl('back_article_index'));            }
        }

        return $this->render(':back/comment:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
