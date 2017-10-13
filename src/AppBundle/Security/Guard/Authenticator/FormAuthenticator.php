<?php

namespace AppBundle\Security\Guard\Authenticator;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class FormAuthenticator
 * @package AppBundle\Security\Guard
 */
class FormAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * Default message for authentication failure.
     *
     * @var string
     */
    private $failMessage = 'Bad credentials.';

    /**
     * FormAuthenticator constructor.
     * @param RouterInterface $router
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->router          = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials(Request $request)
    {
        if ($request->get('_route') != 'login' || !$request->isMethod('POST')) {
            return null;
        }

        $loginData = $request->request->get('login');

        dump($loginData);
        die;

        if (empty($loginData)) {
            return null;
        }

        return [
            'username' => $loginData['username'],
            'password' => $loginData['password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            return $userProvider->loadUserByUsername($credentials['username']);
        } catch (UsernameNotFoundException $e) {
            throw new CustomUserMessageAuthenticationException($this->failMessage);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $plainPassword = $credentials['password'];

        if (!$this->passwordEncoder->isPasswordValid($user, $plainPassword)) {
            throw new CustomUserMessageAuthenticationException($this->failMessage);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        $url = $this->router->generate('back_index');

        return new RedirectResponse($url);
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        $url = $this->router->generate('front_login');

        return new RedirectResponse($url);
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $url = $this->router->generate('front_login');

        return new RedirectResponse($url);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
