<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ProduitFiniController extends Controller
{
    public function produitFiniIdcaptAction()
    {
        return $this->render('ICAffichageBundle:produitFini:lecteur.html.twig');
    }

    public function produitFiniIdentifiantAction()
    {
        return $this->render('ICAffichageBundle:produitFini:identifiant.html.twig');
    }

    public function produitFiniLecteurCVAction()
    {
        return $this->render('ICAffichageBundle:produitFini:lecteurcv.html.twig');
    }
        
    public function menuAction()
    {
        $repositoryFamille = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Famille');
        $repositorySousFamille = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:SousFamille');
        $repositoryNomenclature = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Nomenclature');
        
        $listFamille = $repositoryFamille->findAll();
        $listSousFamille = $repositorySousFamille->findAll();
        $listnomenclature = $repositorySousFamille->findAll();
        
        $repository = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:SousTraitant');
        $sousTraitant = $repository->findAll();
        
        $form = $this->createForm(new ComposantInterneType($listFamille, $listSousFamille));

        return $this->render('ICAffichageBundle:MenuVertical:menu.html.twig', array('form' => $form->createView(), 'sousTraitants' => $sousTraitant));
    }
}