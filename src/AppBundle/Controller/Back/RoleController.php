<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\User\Role;
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
}
