<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Front\Contact;
use AppBundle\Form\Type\Front\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request)
    {

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                var_dump($form->getData());
                var_dump($contact->getFirstName());
            }
        }

        return $this->render(':front:contact.html.twig', array(
            'form' => $form->createView()
        ));        
    }
}