<?php

namespace AppBundle\Form\Type\Article;

use AppBundle\Form\DataTransformer\TagsTransformer;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class TagsType
 * @package AppBundle\Form\Type\Article
 */
class TagsType extends AbstractType
{
    /**
     * @return string
     */
    public function getParent()
    {
        return TextType::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tags_form';
    }
}