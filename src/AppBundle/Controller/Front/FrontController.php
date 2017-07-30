<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontController extends Controller
{
	/**
	commentaire
	**/
    public function indexAction()
    {
		$tabs = array(
			'un' => 'test',
			'deux' => 'test',
			'trois' => 'test',
			'quatre' => 'test'
		);

		return $this->render(':front:index.html.twig', array(
		  'tabs' => $tabs
		));
    }

    /**
	commentaire
    **/
    public function contactAction()
    {
        return $this->render(':front:contact.html.twig');
    }
}