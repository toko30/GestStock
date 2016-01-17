<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatierePremiereController extends Controller
{
    public function affichageMatierePremiereAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('partie' => 'Administration', 'name' => 'test'));
    }
    
    public function affichageAddMatierePremiereAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function affichageModifierMatierePremiereAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function affichageDeleteMatierePremiereAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function affichageAddFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function affichageModifierFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function affichageDeleteFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
}
