<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ComposantController extends Controller
{
    public function interneAction(Request $request)
    {
        $etat[0] = 0;
        
        if('POST' == $request->getMethod())
        {
            if(!empty($_POST['formComposantInterne']['etat']))
                $etat[0] = $_POST['formComposantInterne']['etat'];   
                
            if(empty($_POST['formComposantInterne']['fournisseur']))
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST['formComposantInterne']);
            else
            {
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Moq')->getStockFournisseurByCritere($_POST['formComposantInterne']); 
                return $this->render('ICAffichageBundle:Composant:interneFournisseur.html.twig', array('composants1' => $listComposant, 'etat' => $etat));           
            }       
        }
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->findAll();

        return $this->render('ICAffichageBundle:Composant:interne.html.twig', array('composants' => $listComposant, 'etat' => $etat));
    }
    
    public function soustraitantAction(Request $request, $id)
    {
        if('POST' == $request->getMethod())
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST);
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ComposantSousTraitant')->getComposantSousTraitantById($id);  
                  
        return $this->render('ICAffichageBundle:Composant:sousTraitant.html.twig', array('composantSousTraitants'=> $listComposant));
    }
}
