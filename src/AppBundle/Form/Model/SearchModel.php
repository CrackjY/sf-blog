<?php

namespace AppBundle\Form\Model;

/**
 * Class SearchModel
 * @package AppBundle\Form\Model
 */
class SearchModel
{
    /**
     * @var $categories
     */
    public $categories;

    /**
     * @var string
     */
    public $term;

    /**
     * @var $date_start
     */
    public $date_start;

    /**
     * @var $date_end
     */
    public $date_end;

    /**
     * @return mixed
     */
    public function getByCategories()
    {
        return $this->categories;
    }

    /**
     * @param $categories
     * @return $this
     */
    public function setByCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param $term
     * @return $this
     */
    public function setTerm($term)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param $date_start
     * @return $this
     */
    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * @param $date_end
     * @return $this
     */
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;

        return $this;
    }
}
