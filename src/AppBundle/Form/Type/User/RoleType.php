<?php

namespace AppBundle\Form\Type\User;

use AppBundle\Entity\User\Role;
use AppBundle\Entity\User\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RoleType
 * @package AppBundle\Form\Type\User
 */
class RoleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Role',
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
                'data_class' => Role::class,
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'role_form';
    }
}
