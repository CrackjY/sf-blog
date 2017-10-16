<?php

namespace AppBundle\Entity\User;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="sf_blog_role")
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article\Category", mappedBy="roles", cascade={"persist"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="sf_blog_role_user_join")
     *
     * @var ArrayCollection
     */
    private $users;


    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }
}
