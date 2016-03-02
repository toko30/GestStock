<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\AdministrationBundle\Form\Type\AddFournisseurType;
use IC\AdministrationBundle\Form\Type\UpdateFournisseurType;
use IC\AdministrationBundle\Entity\Fournisseur;

class FirmwareController extends Controller
{
    public function affichageFirmwareAction()
    {
        $em = $this->getDoctrine()->getManager();
   
        return $this->render('ICAdministrationBundle:firmware:affichage.html.twig', array('partie' => 'Administration'));
    }
}
