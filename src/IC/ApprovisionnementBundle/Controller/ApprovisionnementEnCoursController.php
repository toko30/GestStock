<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApprovisionnementEnCoursController extends Controller
{
    public function approEnCoursMPAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:matierePremiere.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approEnCoursPFIdentifiantAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:produitsFinisIdentifiant.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approEnCoursPFAutreAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:produitsFinisAutre.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approEnCoursSousTraitantAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:sousTraitant.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
}
