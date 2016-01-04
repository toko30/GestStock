<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ApprovisionnementController extends Controller
{
    public function approvisionnementInterneAction()
    {
        $appro = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproComposant')->getApproInterne();
        
        return $this->render('ICAffichageBundle:Appro:approInterne.html.twig', array('partie' => 'affichage', 'appro' => $appro));
    }
    
    public function approvisionnementSousTraitantAction($id)
    {
        $appro = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproComposant')->getApproSousTraitant($id);
        
        return $this->render('ICAffichageBundle:Appro:approSousTraitant.html.twig', array('partie' => 'affichage', 'appro' => $appro));
    }

    public function approvisionnementIdentifiantAction()
    {
        $appro = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproIdentifiant')->getApproIdentifiant();
        
        return $this->render('ICAffichageBundle:Appro:approIdentifiant.html.twig', array('partie' => 'affichage', 'appro' => $appro));
    }
    
    public function approvisionnementAutreAction()
    {
        $appro = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproAutre')-> getApproLecteur();
        
        return $this->render('ICAffichageBundle:Appro:approAutre.html.twig', array('partie' => 'affichage', 'appro' => $appro));
    }
}
