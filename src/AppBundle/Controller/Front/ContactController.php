<?php

namespace AppBundle\Controller\Front;

use AppBundle\Form\Model\ContactModel;
use AppBundle\Form\Type\Front\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request)
    {

        $contactModel = new ContactModel();

        $form = $this->createForm(ContactType::class, $contactModel);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                var_dump($form->getData());
                var_dump($contactModel->getFirstName());

                return $this->redirect('/faq');
            }
        }

        return $this->render(':front:contact.html.twig', array(
            'form' => $form->createView()
        ));        
    }

    public function test(ContactType $contactType)
    {
    	return $contactType;
    }
}