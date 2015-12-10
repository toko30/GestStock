<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use IC\AffichageBundle\Form\ComposantInterneType;
use IC\AffichageBundle\Entity\Composant;
use IC\AffichageBundle\Repository\ComposantRepository;
use Symfony\Component\HttpFoundation\Request;

class ComposantController extends Controller
{
    public function interneAction(Request $request)
    {
        if('POST' == $request->getMethod())
            $listComposant = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST);
        else
            $listComposant = $this->getDoctrine()->getEntityManager()->getRepository('ICAffichageBundle:Composant')->findAll();
        
       
        return $this->render('ICAffichageBundle:Composant:interne.html.twig', array('composants' => $listComposant));
    }
    
    public function soustraitantAction($id)
    {
        return $this->render('ICAffichageBundle:Composant:sousTraitant.html.twig', array('sousTraitant'=> $id));
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

        //Création du formulaire de trie pour la page Composant Interne
        $form = $this->createForm(new ComposantInterneType($listFamille, $listSousFamille, $listFournisseur, $listNomenclature));
        
        return $this->render('ICAffichageBundle:MenuVertical:menu.html.twig', array('form' => $form->createView(),
                                                                                    'url' => $url, 
                                                                                    'sousTraitants' => $listSousTraitant, 
                                                                                    'nomenclatures' => $listNomenclature));
    }
}
