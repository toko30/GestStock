<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitFiniController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ICAdministrationBundle:Default:index.html.twig', array('name' => $name));
    }
}
