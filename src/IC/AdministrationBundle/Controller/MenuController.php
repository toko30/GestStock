<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function menuAction()
    {
        return $this->render('ICAdministrationBundle:menuVertical:menu.html.twig');
    }
}
