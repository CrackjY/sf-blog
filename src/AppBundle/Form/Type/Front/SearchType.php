<?php

namespace AppBundle\Form\Type\Front;

use Symfony\Component\Form\AbstractType;
use AppBundle\Form\Model\SearchModel;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SearchType
 * @package AppBundle\Form\Type\Front
 */
class SearchType extends AbstractType
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
                'term',
                SearchType::class,
                [
                    'label'    => 'Search',
                    'required' => false,
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
                'data_class' => SearchModel::class
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
        return 'front_search_form';
    }
}