<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class QualiteController extends Controller
{
    public function affichageQualiteAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $listFournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->findAll();
        
        return $this->render('ICAdministrationBundle:qualite:affichage.html.twig', array('partie' => 'Administration'));
    }
}
