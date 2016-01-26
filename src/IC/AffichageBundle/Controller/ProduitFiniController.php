<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ProduitFiniController extends Controller
{
    public function produitFiniIdcaptAction()
    {
        if(!empty($_POST['formProduitFiniLecteur']))
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur($_POST['formProduitFiniLecteur']);
        else
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur(0);
            
        return $this->render('ICAffichageBundle:produitFini:lecteur.html.twig', array('partie' => 'affichage', 'lecteur' => $nbLecteur));
    }

    public function produitFiniIdentifiantAction()
    {
        if(!empty($_POST['formProduitFiniLecteur']))
            $nbBadge = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Badge')->getStockBadge($_POST['formProduitFiniIdentifiant']);
        else
            $nbBadge = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Badge')->getStockBadge(0);
                    
        return $this->render('ICAffichageBundle:produitFini:identifiant.html.twig', array('partie' => 'affichage', 'badge' => $nbBadge));
    }

    public function produitFiniAutreAction()
    {
        if(!empty($_POST['formProduitFiniLecteur']))
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:LecteurAutre')->countLecteur($_POST['formProduitFiniLecteur']);
        else
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:LecteurAutre')->countLecteur(0); 
            
        $autres = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Autre')->findAll(); 
                   
        return $this->render('ICAffichageBundle:produitFini:autre.html.twig', array('partie' => 'affichage', 'lecteur' => $nbLecteur, 'autres' => $autres));
    }
}
