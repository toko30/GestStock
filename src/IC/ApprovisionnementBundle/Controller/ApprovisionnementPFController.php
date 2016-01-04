<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApprovisionnementPFController extends Controller
{
    public function approProduitsFinisIdentifiantsAction()
    {
        return $this->render('ICApprovisionnementBundle:PF:identifiant.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approProduitsFinisAutresAction()
    {
        return $this->render('ICApprovisionnementBundle:PF:autre.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
}
