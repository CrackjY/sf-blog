<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Front\Article;
use AppBundle\Form\Type\Front\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ArticleController extends Controller
{
    public function articleAction(Request $request, EntityManagerInterface $entityManager)
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

        return $this->render(':front:article.html.twig', array(
            'form' => $form->createView(),
            'articles' => $articles
        ));
    }
}