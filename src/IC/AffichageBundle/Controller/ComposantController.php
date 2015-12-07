<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComposantController extends Controller
{
    public function interneAction()
    {
        return $this->render('ICAffichageBundle:Composant:interne.html.twig');
    }
}
