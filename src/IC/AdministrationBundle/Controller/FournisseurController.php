<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\AdministrationBundle\Form\Type\AddFournisseurType;
use IC\AdministrationBundle\Form\Type\UpdateFournisseurType;

class FournisseurController extends Controller
{
    public function affichageFournisseurAction($idFournisseur)
    {
        $em = $this->getDoctrine()->getManager();
        
        $listFournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->findAll();
        
        if($idFournisseur != null)
        {
            $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($idFournisseur);
            $formFournisseur = $this->createForm(new UpdateFournisseurType($this->generateUrl('ic_administration_fournisseur_update', array('idFournisseur' => $idFournisseur)), $fournisseur));
        }  
        else
            $formFournisseur = $this->createForm(new AddFournisseurType($this->generateUrl('ic_administration_fournisseur_add')));
        
        return $this->render('ICAdministrationBundle:fournisseur:affichage.html.twig', array('partie' => 'Administration', 
                                                                                             'form' => $formFournisseur->createView(),
                                                                                             'idFournisseur' => $idFournisseur,
                                                                                             'fournisseurs' => $listFournisseur));
    }
    
    public function AddFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function updateFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function deleteFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:Default:index.html.twig', array('name' => $name));
    }
}
