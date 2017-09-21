<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use AppBundle\Entity\Article\Comment;
use AppBundle\Entity\Front\Contact;
use AppBundle\Form\Type\Front\CategoryType;
use AppBundle\Form\Type\Front\ContactType;
use AppBundle\Form\Type\Article\ArticleType;
use AppBundle\Form\Type\Article\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FrontController
 * @package AppBundle\Controller\Front
 */
class FrontController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function menuAction(EntityManagerInterface $entityManager)
    {
        $categories = $entityManager->getRepository(Category::class)->findByActive();

        return $this->render(':front/includes:menu_front.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function indexAction(EntityManagerInterface $entityManager)
    {
        $articles = $entityManager->getRepository(Article::class)->findByActive();

        return $this->render(':front:index.html.twig', array(
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
