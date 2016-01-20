<?php

namespace IC\ProductionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\Type\ComposantInterneType;
use IC\AffichageBundle\Form\Type\ComposantSousTraitantType;
use IC\AffichageBundle\Form\Type\ProduitFiniLecteurType;
use IC\AffichageBundle\Form\Type\ProduitFiniIdentifiantType;

class MenuController extends Controller
{
    public function menuAction($url)
    {
        //Connexion Doctrine
        $em = $this->getDoctrine()->getManager();
        
        //Liste des requètes Doctrine pour les options du menu
        $listSousTraitant = $em->getRepository('ICProductionBundle:SousTraitant')->findAll();
        
        //génération du template Twig
        return $this->render('ICProductionBundle:MenuVertical:menu.html.twig', array('url' => $url,
                                                                                     'sousTraitants' => $listSousTraitant));
    }
}
