<?php

namespace AppBundle\Form\Type\User;

use AppBundle\Entity\User\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LoginType
 * @package AppBundle\Form\Type\User
 */
class LoginType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Username',
                    ],
                ]
            )
            ->add('password',
                PasswordType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Password',
                    ],
                ]
            );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'login_form';
    }
}
