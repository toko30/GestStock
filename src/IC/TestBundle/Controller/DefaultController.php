<?php

namespace IC\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ICTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
