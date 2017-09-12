<?php

namespace AppBundle\Entity\Front;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="sf_blog_front_comment")
 */
class Comment
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Article::class", inversedBy="content")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=10000, name="content")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", name="date")
     */
    private $date;

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}