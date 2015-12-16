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
        
        //Partie Recherche et trie des composant
        if('POST' == $request->getMethod())
        {
            var_dump($form->getData());
            if(!empty($_POST['formComposantInterne']['etat']))
                $etat[0] = $_POST['formComposantInterne']['etat'];   
            
            //Recherche Par fournisseur ou par référence    
            if(!empty($_POST['formComposantInterne']['fournisseur']) || ($_POST['formComposantInterne']['choixRecherche'] == 1 && !empty($_POST['formComposantInterne']['recherche'])))
            {
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Moq')->getStockFournisseurByCritere($_POST['formComposantInterne']); 
                
                if(!empty($_POST['formComposantInterne']['recherche']) && empty($_POST['formComposantInterne']['fournisseur']))
                    return $this->render('ICAffichageBundle:Composant:interneReference.html.twig', array('composants' => $listComposant, 'etat' => $etat));
                else             
                    return $this->render('ICAffichageBundle:Composant:interneFournisseur.html.twig', array('composants1' => $listComposant, 'etat' => $etat));                 
            } 
            else
                //recheche basique par composant
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST['formComposantInterne']);
        }
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->findAll();

        return $this->render('ICAffichageBundle:Composant:interne.html.twig', array('composants' => $listComposant, 'etat' => $etat));
    }
    
    public function soustraitantAction(Request $request, $id)
    {
        if('POST' == $request->getMethod())
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockSousTraitantkByCritere($_POST, $id);
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ComposantSousTraitant')->getStockSousTraitantById($id);  
                  
        return $this->render('ICAffichageBundle:Composant:sousTraitant.html.twig', array('composantSousTraitants'=> $listComposant));
    }
}
