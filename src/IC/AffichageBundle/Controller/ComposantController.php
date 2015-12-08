<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AffichageBundle\Form\ComposantInterneType;

class ComposantController extends Controller
{
    public function interneAction()
    {
        return $this->render('ICAffichageBundle:Composant:interne.html.twig');
    }
    public function soustraitantAction($id)
    {
        return $this->render('ICAffichageBundle:Composant:sous-traitant.html.twig', array('sousTraitant'=> $id));
    }
    
    public function menuAction()
    {
        $repositoryFamille = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Famille');
        $repositorySousFamille = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:SousFamille');
        
        $listFamille = $repositoryFamille->findAll();
        $listSousFamille = $repositorySousFamille->findAll();
        
        $repository = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:SousTraitant');
        $sousTraitant = $repository->findAll();
        
        $form = $this->createForm(new ComposantInterneType($listFamille, $listSousFamille));

        return $this->render('ICAffichageBundle:MenuVertical:menu.html.twig', array('form' => $form->createView(), 'sousTraitants' => $sousTraitant));
    }
}
