<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\User\User;
use AppBundle\Form\Type\User\RegisterType;
use AppBundle\Form\Type\User\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package AppBundle\Controller\Back
 */
class UserController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return mixed
     */
    public function indexAction(EntityManagerInterface $entityManager)
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render(':back/user:index.html.twig', array(
            'users' => $users,
        ));

    }

    /**
     * @param Request                $request
     * @param EntityManagerInterface $entityManager
     * @return                       Response
     */
    public function newAction(Request $request, EntityManagerInterface $entityManager)
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();
            }
        }

        return $this->render(':back/user:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $userId
     * @return Response
     */
    public function showAction(Request $request, EntityManagerInterface $entityManager, $userId)
    {
        $user = $entityManager->getRepository(User::class)->find($userId);

        return $this->render(':back/user:show.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $userId
     * @return Response
     */
    public function updateAction(Request $request, EntityManagerInterface $entityManager, $userId)
    {
        $user = $entityManager->getRepository(User::class)->find($userId);
        $form = $this->createForm(UserType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();
            }
        }

        return $this->render(':back/user:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction(EntityManagerInterface $entityManager,$userId)
    {

        $user = $entityManager->getRepository(User::class)->find($userId);

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('GuestBundle:Page:viewGuests.html.twig'));
    }
}
