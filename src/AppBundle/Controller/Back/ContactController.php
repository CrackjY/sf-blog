<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\Front\Contact;
use AppBundle\Form\Type\Front\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ContactController
 *
 * @package AppBundle\Controller\Back
 */
class ContactController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(EntityManagerInterface $entityManager)
    {
        $contacts = $entityManager->getRepository(Contact::class)->findAll();

        return $this->render(':Back/contact:list.html.twig', array(
            'contacts' => $contacts
        ));
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param                        $contactId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(EntityManagerInterface $entityManager, $contactId)
    {
        $contact = $entityManager->getRepository(Contact::class)->find($contactId);

        return $this->render(':Back/contact:show.html.twig', array(
            'contact' => $contact
        ));
    }

    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @param                        $contactId
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @param EntityManagerInterface $entityManager
     * @param                        $contactId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(EntityManagerInterface $entityManager, $contactId)
    {
        $contact = $entityManager->getRepository(Contact::class)->find($contactId);
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('back_contact_list');
    }
}
