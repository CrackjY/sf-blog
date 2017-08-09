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
            ->add('title', ChoiceType::class, 
                array(
                    'choices'  => array(
                        'mr' => 'mr',
                        'mrs' => 'mrs',
                        'other' => 'other',
                    ),
                )
            )            
            ->add(
                'firstname',
                TextType::class,
                [
                    'label'    => 'Firstname',
                    'required' => false,
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label'    => 'Lastname',
                    'required' => false,
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label'    => 'Email',
                    'required' => false,
                ]
            )
            ->add(
                'object',
                TextType::class,
                [
                    'label'    => 'Object',
                    'required' => false,
                ]                
            )
            ->add(
                'message',
                TextareaType::class,
                [
                    'label'    => 'Message',
                    'required' => false,
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label'    => 'Send'
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