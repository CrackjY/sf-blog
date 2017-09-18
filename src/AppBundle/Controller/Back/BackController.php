<?php

namespace AppBundle\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class BackController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render(':back:admin.html.twig');
    }
}
