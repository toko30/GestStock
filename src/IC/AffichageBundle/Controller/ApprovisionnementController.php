<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApprovisionnementController extends Controller
{
    public function approvisionnementInterneAction()
    {
        $appro = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproComposant')->getApproInterne();
        
        return $this->render('ICAffichageBundle:Appro:approInterne.html.twig', array('partie' => 'affichage', 'appro' => $appro));
    }

    public function approvisionnementIdentifiantAction()
    {
        $appro = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproIdentifiant')->getApproIdentifiant();
        
        return $this->render('ICAffichageBundle:Appro:approIdentifiant.html.twig', array('partie' => 'affichage', 'appro' => $appro));
    }
    
    public function approvisionnementAutreAction()
    {
        $approLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproLecteur')-> getApproLecteur();
        $approAutre = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproAutre')-> getApproAutre();
        
        return $this->render('ICAffichageBundle:Appro:approAutre.html.twig', array('partie' => 'affichage', 
                                                                                   'approLecteur' => $approLecteur,
                                                                                   'approAutre' => $approAutre));
    }
}
