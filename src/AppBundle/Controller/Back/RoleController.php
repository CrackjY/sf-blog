<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\User\Role;
use AppBundle\Form\Type\User\RoleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RoleController
 * @package AppBundle\Controller\Back
 */
class RoleController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return mixed
     */
    public function indexAction(EntityManagerInterface $entityManager)
    {
        $roles = $entityManager->getRepository(Role::class)->findAll();

        return $this->render(':back/role:index.html.twig', array(
            'roles' => $roles,
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function newAction(Request $request, EntityManagerInterface $entityManager)
    {
        $role = new Role();

        $form = $this->createForm(RoleType::class, $role);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($role);
                $entityManager->flush();
            }
        }

        return $this->render(':back/role:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $roleId
     * @return Response
     */
    public function showAction(Request $request, EntityManagerInterface $entityManager, $roleId)
    {
        $role = $entityManager->getRepository(Role::class)->find($roleId);

        return $this->render(':back/role:show.html.twig', array(
            'user' => $role,
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param $roleId
     * @return Response
     */
    public function updateAction(Request $request, EntityManagerInterface $entityManager, $roleId)
    {
        $role = $entityManager->getRepository(Role::class)->find($roleId);
        $form = $this->createForm(RoleType::class, $role);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($role);
                $entityManager->flush();
            }
        }

        return $this->render(':back/role:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
