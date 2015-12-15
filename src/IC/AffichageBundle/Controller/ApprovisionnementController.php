<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ApprovisionnementController extends Controller
{
    public function approvisionnementInterneAction()
    {
        $appro = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:ApproComposant')->getApproInterne();
        
        return $this->render('ICAffichageBundle:Appro:approInterne.html.twig', array('appro' => $appro));
    }
    
    public function approvisionnementSousTraitantAction($id)
    {
        $appro = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:ApproComposant')->getApproSousTraitant($id);
        
        return $this->render('ICAffichageBundle:Appro:approSousTraitant.html.twig', array('appro' => $appro));
    }

    public function approvisionnementIdentifiantAction()
    {
        return $this->render('ICAffichageBundle:Appro:approIdentifiant.html.twig');
    }
    
    public function approvisionnementLecteurCVAction()
    {
        return $this->render('ICAffichageBundle:Appro:approLecteurCV.html.twig');
    }
}