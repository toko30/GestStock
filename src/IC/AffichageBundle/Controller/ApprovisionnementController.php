<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ApprovisionnementController extends Controller
{
    public function approvisionnementInterneAction()
    {
        return $this->render('ICAffichageBundle:Appro:approInterne.html.twig');
    }
    
    public function approvisionnementSousTraitantAction($id)
    {
        return $this->render('ICAffichageBundle:Appro:approSousTraitant.html.twig');
    }

    public function approvisionnementIdentifiantAction()
    {
        return $this->render('ICAffichageBundle:Appro:approIdentifiant.html.twig');
    }
    
    public function approvisionnementLecteurCVAction()
    {
        return $this->render('ICAffichageBundle:Appro:approLecteurCV.html.twig');
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