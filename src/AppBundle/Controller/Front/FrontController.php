<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontController extends Controller
{
    public function indexAction()
    {
        $firstnames = array(
            'antoine',
            'toto',
            'yassine',
            'eric',
            'etienne'
        );

        return $this->render(':front:index.html.twig', array(
            'firstnames' => $firstnames
        ));
    }

    public function faqAction()
    {
        return $this->render(':front:faq.html.twig');
    }
}