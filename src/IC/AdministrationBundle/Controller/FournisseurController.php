<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FournisseurController extends Controller
{
    public function indexAction()
    {
        return $this->render('ICAdministrationBundle:Default:index.html.twig', array('name' => $name));
    }
}
