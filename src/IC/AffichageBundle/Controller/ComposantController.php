<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ComposantController extends Controller
{
    public function interneAction(Request $request)
    {
        $etat[0] = 0;
        
        //Partie Recherche et trie des composants
        if('POST' == $request->getMethod())
        {
            $data = $request->get('formComposantInterne');
            
            if(!empty($data['etat']))
                $etat[0] = $data['etat'];   

            //Recherche Par fournisseur ou par référence    
            if(!empty($data['fournisseur']) || ($data['choixRecherche'] == 1 && !empty($data['recherche'])))
            {
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Moq')->getStockFournisseurByCritere($data); 
                
                if(!empty($data['recherche']) && empty($data['fournisseur']))
                    return $this->render('ICAffichageBundle:Composant:interneReference.html.twig', array('partie' => 'affichage', 'composants' => $listComposant, 'etat' => $etat));
                else             
                    return $this->render('ICAffichageBundle:Composant:interneFournisseur.html.twig', array('partie' => 'affichage', 'composants1' => $listComposant, 'etat' => $etat));                 
            } 
            else
                //recheche basique par composant
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($data);
        }
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere(0);

        return $this->render('ICAffichageBundle:Composant:interne.html.twig', array('partie' => 'affichage', 'composants' => $listComposant, 'etat' => $etat));
    }
    
    public function soustraitantAction(Request $request, $id)
    {
        //Partie Recherche et trie des composants
        if('POST' == $request->getMethod())
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ComposantSousTraitant')->getStockSousTraitantkByCritere($request->get('formComposantSousTraitant'), $id);           
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ComposantSousTraitant')->getStockSousTraitantById($id);  
                  
        return $this->render('ICAffichageBundle:Composant:sousTraitant.html.twig', array('partie' => 'affichage', 'composantSousTraitants'=> $listComposant));
    }
    public function detailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->find($id);
        $listComposantFournisseur = $em->getRepository('ICAdministrationBundle:ComposantFournisseur')->getListComposantById($id);
        
        return $this->render('ICAffichageBundle:Composant:detail.html.twig', array('partie' => 'affichage', 'composant'=> $composant, 'composantsFournisseur' => $listComposantFournisseur));
    }
}
