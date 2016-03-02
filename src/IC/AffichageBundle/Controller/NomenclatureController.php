<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NomenclatureController extends Controller
{
    public function nomenclatureComposantAction($id)
    {
        $listNomenclature = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ComposantNomenclature')->getComposantNomenclaturePCBById($id);
        
        return $this->render('ICAffichageBundle:Nomenclature:nomenclatureComposant.html.twig', array('partie' => 'affichage', 'nomenclatures' => $listNomenclature));
    }
    
    public function nomenclatureCompleteAction($id)
    {
        $listNomenclature = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ProduitFiniNomenclature')->getProduitFiniNomenclatureById($id);
       
        return $this->render('ICAffichageBundle:Nomenclature:nomenclatureProduitFini.html.twig', array('partie' => 'affichage', 'nomenclatures' => $listNomenclature));
    }  
}
