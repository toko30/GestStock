<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductionController extends Controller
{
    public function productionInterneAction()
    {
        $prod = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Production')->getProdInterne();
        
        return $this->render('ICAffichageBundle:Production:prodInterne.html.twig', array('partie' => 'affichage', 'prod' => $prod));
    }
    
    public function productionSousTraitantAction($id)
    {
        $prod = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Production')->getProdSousTraitant($id);
        
        return $this->render('ICAffichageBundle:Production:prodSousTraitant.html.twig', array('partie' => 'affichage', 'prod' => $prod));
    }    

}
