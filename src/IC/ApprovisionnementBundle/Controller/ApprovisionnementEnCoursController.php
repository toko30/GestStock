<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApprovisionnementEnCoursController extends Controller
{
    public function approInterneProductionAction()
    {
        return $this->render('ICApprovisionnementBundle:Default:index.html.twig', array('name' => 'test'));
    }
}
