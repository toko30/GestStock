<?php

namespace IC\AffichageBundle\Controller;

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
        $listFamille = $em->getRepository('ICAffichageBundle:Famille')->findAll();
        $listSousFamille = $em->getRepository('ICAffichageBundle:SousFamille')->findAll();
        $listFournisseur = $em->getRepository('ICAffichageBundle:Fournisseur')->findAll();
        $listSousTraitant = $em->getRepository('ICAffichageBundle:SousTraitant')->findAll();
        $listNomenclature = $em->getRepository('ICAffichageBundle:Nomenclature')->findAll();
        $listLecteur = $em->getRepository('ICAffichageBundle:SousTypeLecteur')->findAll();
        $listBadge = $em->getRepository('ICAffichageBundle:SousTypeBadge')->findAll();
        $listAppro = $em->getRepository('ICAffichageBundle:Appro')->getListStAppro();
        $listProd = $em->getRepository('ICAffichageBundle:Production')->getListStProd();
        
        //Création des formulaires
        if($url == 'ic_affichage_composant_interne')
            $form = $this->createForm(new ComposantInterneType($listFamille, $listSousFamille, $listFournisseur, $listNomenclature));
        elseif($url == 'ic_affichage_produit_fini_lecteur_cv' || $url == 'ic_affichage_produit_fini_interne')
            $form = $this->createForm(new ProduitFiniLecteurType($listLecteur));
        elseif($url == 'ic_affichage_produit_fini_identifiant')
            $form = $this->createForm(new ProduitFiniIdentifiantType($listBadge));
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
