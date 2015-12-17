<?php
namespace IC\ProductionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductionController extends Controller
{
    public function interneAction()
    {
        return $this->render('ICProductionBundle:Production:interne.html.twig');
    }
    public function sousTraitantAction($id)
    {
        return $this->render('ICProductionBundle:Production:sousTraitant.html.twig');
    }
}
