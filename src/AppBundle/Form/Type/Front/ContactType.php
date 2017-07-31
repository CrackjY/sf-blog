<?php

namespace AppBundle\Form\Type\Front;

use AppBundle\Form\Model\ContactModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
            ->add(
                'firstname',
                TextType::class,
                [
                    'label'    => 'Prénom',
                    'required' => false,
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label'    => 'Nom',
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
            )
            ->getForm();                      
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
                'data_class' => ContactModel::class,
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