<?php

namespace AppBundle\Model;

class ContactModel
{
    protected $firstname;
    protected $name;
    protected $email;
    protected $object;
    protected $message;

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName()
    {
        $this->firstname = $firstname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName()
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail()
    {
        $this->email = $email;
    }  

    public function getObject()
    {
        return $this->object;
    }

    public function setObject()
    {
        $this->object = $object;
    } 

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage()
    {
        $this->message = $message;
    }
}