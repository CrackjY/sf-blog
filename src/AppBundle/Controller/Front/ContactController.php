<?php

namespace AppBundle\Controller\Front;

use AppBundle\Form\Model\ContactModel;
use AppBundle\Form\Type\Front\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction()
    {
    	$contactModel = new ContactModel();

    	$form = $this->createForm(ContactType::class, $contactModel);

    	return $this->render(':front:contact.html.twig');
    }
}