<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MenuController extends Controller
{
    public function menuAction($url)
    {
        //Connexion Doctrine
        $em = $this->getDoctrine()->getManager();
        
        //Liste des requètes Doctrine pour les options du menu
        //$listSousTraitant = $em->getRepository('ICProductionBundle:SousTraitant')->findAll();
        //Création des formulaires en focntion de la page
        
        //génération du template Twig
        return $this->render('ICApprovisionnementBundle:MenuVertical:menu.html.twig', array('url' => $url,
                                                                                     'sousTraitants' => '1'));
    }
}
