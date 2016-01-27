<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\AdministrationBundle\Entity\SousFamille;

class OptionController extends Controller
{
    public function sousFamilleAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $listFamille = $em->getRepository('ICAdministrationBundle:Famille')->findAll();
        $listSousFamille = $em->getRepository('ICAdministrationBundle:SousFamille')->findAll();
        
        return $this->render('ICAdministrationBundle:option:sousFamille.html.twig', array('partie' => 'Administration', 'listFamille' => $listFamille, 'listSousFamille' => $listSousFamille));
    }
    
    public function AddsousFamilleAction(request $request, $idFamille)
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
}