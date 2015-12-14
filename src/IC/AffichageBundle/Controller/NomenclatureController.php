<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class NomenclatureController extends Controller
{
    public function nomenclatureComposantAction($id)
    {
        return $this->render('ICAffichageBundle:Nomenclature:nomenclatureComposant.html.twig');
    }
    
    public function nomenclatureCompleteAction($id)
    {
        return $this->render('ICAffichageBundle:Nomenclature:nomenclatureComplete.html.twig');
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