<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApprovisionnementPFController extends Controller
{
    public function approInterneProductionAction()
    {
        return $this->render('ICApprovisionnementBundle:Default:index.html.twig', array('name' => 'test'));
    }
}
