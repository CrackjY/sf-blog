<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FrontController extends Controller
{
    public function indexAction()
    {
        $firstnames = array(
            'antoine',
            'toto',
            'yassine',
            'eric',
            'etienne'
        );

        $peoples =  array(
                        array(
                            'firstname' => 'tom',
                            'lastname' => 'tod',
                            'children' => array(
                                array(
                                    'firstname' => 'uiui',
                                    'lastname' => 'uouo',
                                    'age' => 8
                                ),
                                array(
                                    'firstname' => 'qsqqs',
                                    'lastname' => 'asas',
                                    'age' => 6
                                ),
                                array(
                                    'firstname' => 'vvbb',
                                    'lastname' => 'vcvc',
                                    'age' => 4
                                )
                            )
                        ),
                        array(
                            'firstname' => 'dqdq',
                            'lastname' => 'dqdq',
                            'children' => array(
                                array(
                                    'firstname' => 'uiui',
                                    'lastname' => 'uouo',
                                    'age' => 8
                                    ),
                                array(
                                    'firstname' => 'qsqqs',
                                    'lastname' => 'asas',
                                    'age' => 6
                                ),
                                array(
                                    'firstname' => 'vvbb',
                                    'lastname' => 'vcvc',
                                    'age' => 4
                                )
                            )
                        ),
                        array(
                            'firstname' => 'dede',
                            'lastname' => 'dada',
                            'children' => array(
                                array(
                                    'firstname' => 'uiui',
                                    'lastname' => 'uouo',
                                    'age' => 8
                                ),
                                array(
                                    'firstname' => 'qsqqs',
                                    'lastname' => 'asas',
                                    'age' => 6
                                ),
                                array(
                                    'firstname' => 'vvbb',
                                    'lastname' => 'vcvc',
                                    'age' => 4
                                )
                            )
                        )
                    );

        return $this->render(':front:index.html.twig', array(
            'firstnames' => $firstnames,
            'peoples' => $peoples
        ));
    }

    public function faqAction()
    {
        return $this->render(':front:faq.html.twig');
    }
}