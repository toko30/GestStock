<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function MenuAction()
    {
        return $this->render('ICAffichageBundle:Menu:Menu.html.twig');
    }
}
