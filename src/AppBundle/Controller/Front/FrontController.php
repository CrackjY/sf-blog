<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use AppBundle\Entity\Article\Comment;
use AppBundle\Entity\Front\Contact;
use AppBundle\Form\Type\Front\ContactType;
use AppBundle\Form\Type\Article\ArticleType;
use AppBundle\Form\Type\Article\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class FrontController extends Controller
{
    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @param                        $articleId
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

        return $this->render(':front:index.html.twig', array(
            'form' => $form->createView(),
            'articles' => $articles
        ));
    }

    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction(Request $request, EntityManagerInterface $entityManager)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($contact);
                $entityManager->flush();
            }
        }

        return $this->render(':front:contact.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function faqAction()
    {
        return $this->render(':front:faq.html.twig');
    }
}
