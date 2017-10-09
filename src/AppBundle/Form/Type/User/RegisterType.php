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
 * Class RegisterType
 * @package AppBundle\Form\Type\User
 */
class RegisterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Username',
                    ],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Email',
                    ],
                ]
            )
            ->add('plainPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'required' => true,
                    'first_options'  => [
                        'label' => 'Password',
                        'attr'  => [
                            'placeholder' => 'Enter password',
                        ],
                    ],
                    'second_options' => [
                        'label' => 'Repeat Password',
                        'attr'  => [
                        'placeholder' => 'Repeat password',
                        ],
                    ],
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'register_form';
    }
}
