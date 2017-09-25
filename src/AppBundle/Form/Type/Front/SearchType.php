<?php

namespace AppBundle\Form\Type\Front;

use AppBundle\Form\Model\SearchModel;
use AppBundle\Entity\Article\Category;
use AppBundle\Entity\Article\Article;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SearchType
 * @package AppBundle\Form\Type\Front
 */
class SearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories',  EntityType::class,
                [
                    'class'         => Category::class,
                    'query_builder' => function(EntityRepository $er) {
                        return $er
                            ->createQueryBuilder('ca')
                            ->orderBy('ca.name', 'ASC');
                    },
                    'expanded' => true,
                    'multiple'       => true,
                    'choice_label'   => 'name',
                    'required'    => false,
                ]
            )
            ->add(
                'term',
                TextType::class,
                [
                    'label'       => 'Search',
                    'required'    => false,
                    'attr'        => array(
                        'placeholder' => 'Search'
                    ),
                ]
            )
            ->add(
                'startDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'  => 'Start date',
                    'required'    => false,
                ]
            )
            ->add(
                'endDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label'  => 'End date',
                    'required'    => false,
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
                'data_class' => SearchModel::class,
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
