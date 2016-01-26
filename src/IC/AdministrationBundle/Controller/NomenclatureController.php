<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NomenclatureController extends Controller
{
    public function affichageNomenclatureAction($allVersion)
    {
        $em = $this->getDoctrine()->getManager();

        $nomenclatures = $em->getRepository('ICAdministrationBundle:VersionNomenclature')->getLastVersionNomenclature($allVersion);

        return $this->render('ICAdministrationBundle:nomenclature:affichage.html.twig', array('partie' => 'Administration', 
                                                                                              'nomenclatures' => $nomenclatures, 
                                                                                              'allVersion' => $allVersion));
    }
    
    public function affichageComposantNomenclatureAction($idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();
        
        $composantNomenclature = $em->getRepository('ICAdministrationBundle:ComposantNomenclature')->getComposantByNomenclature($idNomenclature);
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->getComposantPCB();

        return $this->render('ICAdministrationBundle:nomenclature:affichageComposantPCB.html.twig', array('partie' => 'Administration',
                                                                                                          'composants' => $composant,
                                                                                                          'composantsNomenclature' => $composantNomenclature));        
    }
    
    public function affichageProduitFiniNomenclatureAction($idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();
        
        $produitFiniNomenclature = $em->getRepository('ICAdministrationBundle:ProduitFiniNomenclature')->getComposantByNomenclature($idNomenclature);
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->getComposantProduitFini();
        
        return $this->render('ICAdministrationBundle:nomenclature:affichageProduitFini.html.twig', array('partie' => 'Administration', 
                                                                                                         'composants' => $composant,
                                                                                                         'produitsFinisNomenclature' =>$produitFiniNomenclature));   
    }
    
    public function ajouterNomenclatureAction()
    {
        
    }
        
    public function ajouterVersionNomenclatureAction($idNomenclature)
    {
        
    }
    
    public function modifierNomenclatureAction($idNomenclature)
    {
        
    }    
}
