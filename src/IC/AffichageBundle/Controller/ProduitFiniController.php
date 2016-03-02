<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitFiniController extends Controller
{
    public function produitFiniIdcaptAction(request $request)
    {
        $formProduitFiniLecteur = $request->get('formProduitFiniLecteur');
        
        if(!empty($formProduitFiniLecteur))
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur($formProduitFiniLecteur);
        else
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Lecteur')->countLecteur(0);
            
        return $this->render('ICAffichageBundle:produitFini:lecteur.html.twig', array('partie' => 'affichage', 'lecteur' => $nbLecteur));
    }

    public function produitFiniIdentifiantAction(request $request)
    {
        $formProduitFiniIdentifiant = $request->get('formProduitFiniIdentifiant');
        
        if(!empty($formProduitFiniIdentifiant))
            $nbBadge = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Badge')->getStockBadge($formProduitFiniIdentifiant);
        else
            $nbBadge = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Badge')->getStockBadge(0);
                    
        return $this->render('ICAffichageBundle:produitFini:identifiant.html.twig', array('partie' => 'affichage', 'badge' => $nbBadge));
    }

    public function produitFiniAutreAction(request $request)
    {
        $formProduitFiniLecteur = $request->get('formProduitFiniLecteur');
        
        if(!empty($formProduitFiniLecteur))
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:LecteurAutre')->countLecteur($formProduitFiniLecteur);
        else
            $nbLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:LecteurAutre')->countLecteur(0); 
            
        $autres = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Autre')->findAll(); 
                   
        return $this->render('ICAffichageBundle:produitFini:autre.html.twig', array('partie' => 'affichage', 'lecteur' => $nbLecteur, 'autres' => $autres));
    }
}
