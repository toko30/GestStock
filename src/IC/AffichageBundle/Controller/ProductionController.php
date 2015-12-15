<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ProductionController extends Controller
{
    public function productionInterneAction()
    {
        $prod = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:Production')->getProdInterne();
        
        return $this->render('ICAffichageBundle:Production:prodInterne.html.twig', array('prod' => $prod));
    }
    
    public function productionSousTraitantAction($id)
    {
        $prod = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:Production')->getProdSousTraitant($id);
        
        return $this->render('ICAffichageBundle:Production:prodSousTraitant.html.twig', array('prod' => $prod));
    }    

}
