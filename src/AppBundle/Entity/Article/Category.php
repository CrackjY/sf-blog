<?php

namespace AppBundle\Entity\Article;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Article\Article;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Article\Repository\CategoryRepository")
 * @ORM\Table(name="sf_blog_category")
 */
class Category
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article\Article", mappedBy="categories", cascade={"persist"}, fetch="EXTRA_LAZY")
     *
     * @var ArrayCollection
     */
    private $articles;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->active = true;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return Category
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param $articles
     * @return $this
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * @param Article $article
     */
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
    }

    /**
     * @param Category $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }
}
