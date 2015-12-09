<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;
use Symfony\Component\HttpFoundation\Response;

class ComposantController extends Controller
{
    public function interneAction()
    {
        $repositoryComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant');
        
        $listComposant = $repositoryComposant->findAll();
        
        return $this->render('ICAffichageBundle:Composant:interne.html.twig', array('composants' => $listComposant));
    }
    public function soustraitantAction($id)
    {
        return $this->render('ICAffichageBundle:Composant:sous-traitant.html.twig', array('sousTraitant'=> $id));
    }
    
    public function menuAction($url)
    {
        //Liste des requètes Doctrine pour les options du menu
        $repositoryFamille = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Famille');
        $repositorySousFamille = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:SousFamille');
        $repositoryFournisseur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Fournisseur');
        $repositorySousTraitant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:SousTraitant');
        $repositoryNomenclature = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Nomenclature');
                
        $listFamille = $repositoryFamille->findAll();
        $listSousFamille = $repositorySousFamille->findAll();
        $listFournisseur = $repositoryFournisseur->findAll();
        $listSousTraitant = $repositorySousTraitant->findAll();
        $listNomenclature = $repositoryNomenclature->findAll();  
        
        //Création du formulaire de trie pour la page Composant Interne
        $form = $this->createForm(new ComposantInterneType($listFamille, $listSousFamille, $listFournisseur, $listNomenclature));
        
        return $this->render('ICAffichageBundle:MenuVertical:menu.html.twig', array('form' => $form->createView(),
                                                                                    'url' => $url, 
                                                                                    'sousTraitants' => $listSousTraitant, 
                                                                                    'nomenclatures' => $listNomenclature));
    }
}
