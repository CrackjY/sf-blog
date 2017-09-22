<?php

namespace AppBundle\Controller\Front;

use AppBundle\Form\Model\SearchModel;
use AppBundle\Form\Type\Front\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SearchController
 * @package AppBundle\Controller\Front
 */
class SearchController extends Controller
{
    public function searchAction(Request $request)
    {
        $search = new SearchModel();

        $form = $this->createForm(SearchType::class, $search);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
        }

        return $this->render(':front/includes/search.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}