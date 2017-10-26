<?php

namespace AppBundle\Form\Type\User;

use AppBundle\Entity\User\User;
use AppBundle\Entity\User\Role;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Class UserType
 * @package AppBundle\Form\Type\User
 */
class UserType extends AbstractType
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
            ->add(
              'roles',
              EntityType::class,
              [
                  'class' => Role::class,
                  'query_builder' => function(EntityRepository $er) {
                      return $er->createQueryBuilder('ro')
                          ->orderBy('ro.name', 'ASC');
                  },
                  'expanded' => true,
                  'multiple'      => true,
                  'choice_label'   => 'name',
                  'required'    => false,
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
        return 'user_form';
    }
}
