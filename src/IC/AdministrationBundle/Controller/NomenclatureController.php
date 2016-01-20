<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NomenclatureController extends Controller
{
    public function affichageNomenclatureAction($name)
    {
        return $this->render('ICAdministrationBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function affichageComposantNomenclatureAction($idNomenclature)
    {
        
    }
    
    public function affichageModifierNomenclatureAction($idNomenclature)
    {
        
    }
    
    public function affichageDeleteNomenclature($idNomenclature)
    {
        
    }
}
