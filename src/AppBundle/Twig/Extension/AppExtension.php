<?php

namespace AppBundle\Twig\Extension;

/**
 * Class AppExtension
 * @package AppBundle\Twig
 */
class AppExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('hook', array($this, 'hook')),
        );
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('length', array($this, 'length')),
        );
    }

    /**
     * @param $author
     * @return string
     */
    public function hook($author)
    {
        return '[' . $author . ']';
    }

    /**
     * @param $title
     * @return int
     */
    public function length($title)
    {
        return strlen($title);
    }
}
