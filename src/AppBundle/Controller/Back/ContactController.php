<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\Front\Contact;
use AppBundle\Form\Type\Front\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends Controller
{
    public function listAction(EntityManagerInterface $entityManager)
    {
        $contacts = $entityManager->getRepository(Contact::class)->findAll();

        return $this->render(':Back/contact:list.html.twig', array(
            'contacts' => $contacts
        ));
    }

    public function showAction(EntityManagerInterface $entityManager, $contactId)
    {
        $contact = $entityManager->getRepository(Contact::class)->find($contactId);

        return $this->render(':Back/contact:show.html.twig', array(
            'contact' => $contact
        ));
    }

    public function updateAction(Request $request, EntityManagerInterface $entityManager, $contactId)
    {
        $contact = $entityManager->getRepository(Contact::class)->find($contactId);

        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($contact);
                $entityManager->flush();
            }
        }

        return $this->render(':Back/contact:update.html.twig', array(
            'form' => $form->createView(),
            'contact' => $contact
        ));
    }

    public function deleteAction(EntityManagerInterface $entityManager, $contactId)
    {
        $contact = $entityManager->getRepository(Contact::class)->find($contactId);
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('back_contact_list');
    }
}