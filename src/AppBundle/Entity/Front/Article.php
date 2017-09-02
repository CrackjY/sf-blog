<?php

namespace AppBundle\Entity\Front;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="sf_blog_front_article")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="date", nullable=true, name="date")
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
        return $this->date = $this->udate('Y-m-d H:i:s.u T');
    }

    public function setDate($date)
    {
        return $this->date = $date;
    }

    private function udate($format = 'u', $utimestamp = null) {
        if (is_null($utimestamp)) {
            $utimestamp = microtime(true);

            $timestamp = floor($utimestamp);
            $milliseconds = round(($utimestamp - $timestamp) * 1000000);

            return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
        }
    }

}