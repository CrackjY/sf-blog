<?php

namespace AppBundle\Form\Type\Front;

use AppBundle\Entity\Front\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
 
class ContactType extends AbstractType
{
    /**
     * BuildForm
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return null
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',
                ChoiceType::class,
                [
                    'choices'  => [
                        'Mr' => 'mr',
                        'Mrs' => 'mrs',
                        'Other' => 'other',
                    ],
                ]
            )            
            ->add(
                'firstname',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Firstname',
                    ],
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Lastname',
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
                'object',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Object',
                    ],
                ]
            )
            ->add(
                'message',
                TextareaType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Message'
                    ],
                ]
            );
    }
    
    /**
     * configureOptions
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Contact::class
            ]
        );
    }
 
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'front_contact_form';
    }
}
