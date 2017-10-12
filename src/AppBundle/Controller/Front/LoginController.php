<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\User\User;
use AppBundle\Form\Type\User\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginController
 * @package AppBundle\Controller\Front
 */
class LoginController extends Controller
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function loginAction(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(LoginType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
        }

        return $this->render(':front:login.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
