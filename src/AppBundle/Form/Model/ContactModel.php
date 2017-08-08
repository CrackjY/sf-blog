<?php

namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ContactModel
{
    /**
     * @Assert\NotBlank()
     */
    protected $firstname;

    /**
     * @Assert\NotBlank()
     */
    protected $lastname;

    /**
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @Assert\NotBlank()
     */
    protected $object;

    /**
     * @Assert\NotBlank()
     */
    protected $message;

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }  

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
    } 

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}