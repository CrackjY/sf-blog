<?php

namespace AppBundle\Controller\Front;

use AppBundle\Model\ContactModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactController extends Controller
{
    public function contactAction()
    {

    	$contact = new ContactModel();
    	$contact->setFirstName('test');
    	$contact->setName('test');
    	$contact->setEmail('test');
    	$contact->setObject('test');
    	$contact->setMessage('test');

    	$form = $this->createFormBuilder($contact)
    		->add('Firstname', TextType::class)
    		->add('Name', TextType::class)
    		->add('Email', EmailType::class)
    		->add('Object', TextType::class)
    		->add('Message', TextareaType::class)
    		->add('save', SubmitType::class, array('label' => 'Send'))
    		->getForm();

        return $this->render(':front:contact.html.twig', array(
        	'form' => $form->createView(),
        ));
    }
}