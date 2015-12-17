<?php

namespace IC\ProductionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PrevisionnelleController extends Controller
{
    public function interneAction()
    {
        return $this->render('ICProductionBundle:Previsionnelle:interne.html.twig');
    }
    public function sousTraitantAction($id)
    {
        return $this->render('ICProductionBundle:Previsionnelle:interne.html.twig');
    }
}
