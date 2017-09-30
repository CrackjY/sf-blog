<?php

namespace AppBundle\Form\Type\Article;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\Category;
use AppBundle\Entity\Article\Tag;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', EntityType::class,
                [
                    'class'         => Category::class,
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('ca')
                            ->orderBy('ca.name', 'ASC');
                    },
                    'expanded' => true,
                    'multiple'      => true,
                    'choice_label'   => 'name',
                    'required'    => false,
                ]
            )
            ->add(
                'title',
                TextType::class,
                [
                    'label'    => 'Title',
                    'required' => false,
                ]
            )
            ->add(
                'content',
                TextareaType::class,
                [
                    'label'    => 'Content',
                    'required' => false,
                ]
            )
            ->add(
                'author',
                TextType::class,
                [
                    'label'    => 'Author',
                    'required' => false,
                ]
            )
            ->add(
                'tags'
            )
            ->add(
                'active',
                CheckboxType::class,
                [
                    'label'    => false,
                    'required' => false,
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label'    => 'Add'
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
                'data_class' => Article::class,
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
        return 'front_article';
    }
}
