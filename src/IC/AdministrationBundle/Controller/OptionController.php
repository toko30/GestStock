<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\AdministrationBundle\Entity\SousFamille;

class OptionController extends Controller
{
    public function sousFamilleAction($idSousFamille)
    {
        $em = $this->getDoctrine()->getManager();
        
        $listFamille = $em->getRepository('ICAdministrationBundle:Famille')->findAll();
        $listSousFamille = $em->getRepository('ICAdministrationBundle:SousFamille')->findAll();
        
        return $this->render('ICAdministrationBundle:option:sousFamille.html.twig', array('partie' => 'Administration', 
                                                                                          'idSousFamille' =>$idSousFamille, 
                                                                                          'listFamille' => $listFamille, 
                                                                                          'listSousFamille' => $listSousFamille));
    }
    
    public function addsousFamilleAction(request $request, $idFamille)
    {
        $em = $this->getDoctrine()->getManager();
        
        $famille = $em->getRepository('ICAdministrationBundle:Famille')->find($idFamille);
        
        $sousFamille = new SousFamille();      
        $sousFamille->setFamille($famille);
        $sousFamille->setNom($request->get('nom'));
        
        $em->persist($sousFamille);
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_affichage_sous_famille');
    }
    
    public function updatesousFamilleAction(request $request, $idSousFamille)
    {
        $em = $this->getDoctrine()->getManager();
        
        $sousFamille = $em->getRepository('ICAdministrationBundle:SousFamille')->find($idSousFamille);

        $sousFamille->setNom($request->get('nom'));
        
        $em->persist($sousFamille);
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_affichage_sous_famille');        
    }
    
    public function typeBadgeAction()
    {
        $em = $this->getDoctrine()->getManager();

        
        return $this->render('ICAdministrationBundle:option:typeBadge.html.twig', array('partie' => 'Administration'));
    }
    
    public function typeLecteurAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        
        return $this->render('ICAdministrationBundle:option:typeLecteur.html.twig', array('partie' => 'Administration'));
    }
    
    public function typeAutreAction()
    {
        $em = $this->getDoctrine()->getManager();

        
        return $this->render('ICAdministrationBundle:option:typeAutre.html.twig', array('partie' => 'Administration'));
    }
}
