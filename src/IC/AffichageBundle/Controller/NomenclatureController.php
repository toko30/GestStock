<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class NomenclatureController extends Controller
{
    public function nomenclatureComposantAction($id)
    {
        $listNomenclature = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:ComposantNomenclature')->getComposantNomenclaturePCBById($id);
        
        return $this->render('ICAffichageBundle:Nomenclature:nomenclatureComposant.html.twig', array('nomenclatures' => $listNomenclature));
    }
    
    public function nomenclatureCompleteAction($id)
    {
        $listNomenclature = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:ComposantNomenclature')->getComposantNomenclatureCompleteById($id);
       
        return $this->render('ICAffichageBundle:Nomenclature:nomenclatureComposant.html.twig', array('nomenclatures' => $listNomenclature));
    }  
}