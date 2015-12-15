<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use IC\AffichageBundle\Form\ComposantInterneType;
use IC\AffichageBundle\Form\ComposantSousTraitantType;


class ComposantController extends Controller
{
    public function interneAction(Request $request)
    {
        if('POST' == $request->getMethod())
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST);
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->findAll();
                var_dump($_POST);
        return $this->render('ICAffichageBundle:Composant:interne.html.twig', array('composants' => $listComposant));
    }
    
    public function soustraitantAction(Request $request, $id)
    {
        if('POST' == $request->getMethod())
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST);
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ComposantSousTraitant')->getComposantSousTraitantById($id);  
                  
        return $this->render('ICAffichageBundle:Composant:sousTraitant.html.twig', array('composantSousTraitants'=> $listComposant));
    }
    
    public function menuAction($url)
    {
        //Connexion Doctrine
        $em = $this->getDoctrine()->getManager();
        
        //Liste des requètes Doctrine pour les options du menu
        $listFamille = $em->getRepository('ICAffichageBundle:Famille')->findAll();
        $listSousFamille = $em->getRepository('ICAffichageBundle:SousFamille')->findAll();
        $listFournisseur = $em->getRepository('ICAffichageBundle:Fournisseur')->findAll();
        $listSousTraitant = $em->getRepository('ICAffichageBundle:SousTraitant')->findAll();
        $listNomenclature = $em->getRepository('ICAffichageBundle:Nomenclature')->findAll();
        $listAppro = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Appro')->getListStAppro();
        $listProd = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Production')->getListStProd();
        
        //Création des formulaire
        if($url == 'ic_affichage_composant_interne')
            $form = $this->createForm(new ComposantInterneType($listFamille, $listSousFamille, $listFournisseur, $listNomenclature));
        else
            $form = $this->createForm(new ComposantSousTraitantType($listFamille, $listSousFamille, $listNomenclature));
            
        return $this->render('ICAffichageBundle:MenuVertical:menu.html.twig', array('form' => $form->createView(),
                                                                                    'url' => $url, 
                                                                                    'sousTraitants' => $listSousTraitant, 
                                                                                    'nomenclatures' => $listNomenclature,
                                                                                    'appro' => $listAppro,
                                                                                    'prod' => $listProd));
    }
}
