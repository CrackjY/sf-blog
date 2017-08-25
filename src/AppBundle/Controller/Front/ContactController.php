<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Front\Contact;
use AppBundle\Form\Type\Front\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends Controller
{
    public function contactAction(Request $request, EntityManagerInterface $entityManager)
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                var_dump($form->getData());

                $entityManager->persist($contact);
                $entityManager->flush();
            }
        }

        return $this->render(':front:contact.html.twig', array(
            'form' => $form->createView()
        ));        
    }

    public function showAction(EntityManagerInterface $entityManager, $contactId)
    {
        $data = $entityManager->getRepository(Contact::class)->find($contactId);

        return $this->render(':front:show_contact.html.twig', array(
            'data' => $data
        ));
    }

    public function updateAction(Request $request, EntityManagerInterface $entityManager, $contactId)
    {
        $data = $entityManager->getRepository(Contact::class)->find($contactId);

        $form = $this->createForm(ContactType::class, $data);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($data);
                $entityManager->flush();
            }
        }

        return $this->render(':front:update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}