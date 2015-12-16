<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ProduitFiniController extends Controller
{
    public function produitFiniIdcaptAction()
    {
        if(!empty($_POST['formProduitFiniLecteur']))
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur($_POST['formProduitFiniLecteur'], 0);
        else
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur(0, 0);
            
        return $this->render('ICAffichageBundle:produitFini:lecteur.html.twig', array('lecteur' => $nbLecteur, 'page' => 'Idcapt'));
    }

    public function produitFiniIdentifiantAction()
    {
        if(!empty($_POST['formProduitFiniLecteur']))
            $nbBadge = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Badge')->getStockBadge($_POST['formProduitFiniIdentifiant']);
        else
            $nbBadge = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Badge')->getStockBadge(0);
                    
        return $this->render('ICAffichageBundle:produitFini:identifiant.html.twig', array('badge' => $nbBadge));
    }

    public function produitFiniLecteurCVAction()
    {
        if(!empty($_POST['formProduitFiniLecteur']))
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur($_POST['formProduitFiniLecteur'], 6);
        else
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur(0, 6); 
                   
        return $this->render('ICAffichageBundle:produitFini:lecteur.html.twig', array('lecteur' => $nbLecteur, 'page' => 'CV'));
    }
}
