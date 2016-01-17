<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatierePremiereController extends Controller
{
    public function affichageMatierePremiereAction($name)
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));
    }
    
    public function addMatierePremiereAction()
    {
        
    }
    
    public function modifierMatierePremiereAction()
    {
        
    }
    
    public function deleteMatierePremiereAction()
    {
        
    }
    
    public function addFournisseurAction()
    {
        
    }
    
    public function modifierFournisseurAction()
    {
        
    }
    
    public function deleteFournisseurAction()
    {
        
    }
}
