<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\User\User;
use AppBundle\Form\Type\User\RegisterType;
use AppBundle\Form\Type\User\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SecurityController
 * @package AppBundle\Controller\User
 */
class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $encoder
     *
     * @return Response
     */
    public function registerAction(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $plainPassword = $user->getPlainPassword();
                $password = $encoder->encodePassword($user, $plainPassword);
                $user->setPassword($password);

                $entityManager->persist($user);
                $entityManager->flush();
            }
        }

        return $this->render(':security:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param AuthenticationUtils $authUtils
     *
     * @return Response
     */
    public function loginAction(Request $request, EntityManagerInterface $entityManager, AuthenticationUtils $authUtils)
    {
        $user = new User();

        $form = $this->createForm(LoginType::class, $user);

        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render(':security:login.html.twig', array(
            'form' => $form->createView(),
            'lastUsername' => $lastUsername,
            'error' => $error,
        ));
    }
}
