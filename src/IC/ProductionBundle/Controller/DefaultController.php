<?php

namespace IC\ProductionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ICProductionBundle:Default:index.html.twig', array('name' => $name));
    }
}
