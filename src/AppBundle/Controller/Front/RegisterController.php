<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\User\User;
use AppBundle\Form\Type\User\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RegisterController
 * @package AppBundle\Controller\Front
 */
class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function registerAction(Request $request, EntityManagerInterface $entityManager)
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

        return $this->render(':front:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}