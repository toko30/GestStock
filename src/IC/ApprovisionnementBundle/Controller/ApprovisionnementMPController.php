<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApprovisionnementMPController extends Controller
{
    public function approInterneProductionAction()
    {
        return $this->render('ICApprovisionnementBundle:MP:production.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approInterneCritiqueAction()
    {
        return $this->render('ICApprovisionnementBundle:MP:critique.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
}
