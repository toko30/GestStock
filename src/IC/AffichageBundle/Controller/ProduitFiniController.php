<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ProduitFiniController extends Controller
{
    public function produitFiniIdcaptAction()
    {
        $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur($_POST['formProduitFiniLecteur'], 0);
        return $this->render('ICAffichageBundle:produitFini:lecteur.html.twig', array('lecteur' => $nbLecteur, 'page' => 'Idcapt'));
    }

    public function produitFiniIdentifiantAction()
    {
         $nbBadge = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Badge')->getStockBadge();
        return $this->render('ICAffichageBundle:produitFini:identifiant.html.twig', array('badge' => $nbBadge));
    }

    public function produitFiniLecteurCVAction()
    {
        $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur($_POST['formProduitFiniLecteur'], 6);
                
        return $this->render('ICAffichageBundle:produitFini:lecteur.html.twig', array('lecteur' => $nbLecteur, 'page' => 'CV'));
    }
}
