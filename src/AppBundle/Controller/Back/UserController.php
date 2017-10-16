<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\User\User;
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
}
