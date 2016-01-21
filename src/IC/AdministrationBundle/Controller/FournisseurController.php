<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\AdministrationBundle\Form\Type\AddFournisseurType;
use IC\AdministrationBundle\Form\Type\UpdateFournisseurType;
use IC\AdministrationBundle\Entity\Fournisseur;

class FournisseurController extends Controller
{
    public function affichageFournisseurAction($idFournisseur)
    {
        $em = $this->getDoctrine()->getManager();
        
        $listFournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->findAll();
        
        if($idFournisseur != null)
        {
            $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($idFournisseur);
            $formFournisseur = $this->createForm(new UpdateFournisseurType($this->generateUrl('ic_administration_fournisseur_update', array('idFournisseur' => $idFournisseur))), $fournisseur);
        }  
        else
            $formFournisseur = $this->createForm(new AddFournisseurType($this->generateUrl('ic_administration_fournisseur_add')));
        
        return $this->render('ICAdministrationBundle:fournisseur:affichage.html.twig', array('partie' => 'Administration', 
                                                                                             'form' => $formFournisseur->createView(),
                                                                                             'idFournisseur' => $idFournisseur,
                                                                                             'fournisseurs' => $listFournisseur));
    }
    
    public function AddFournisseurAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $formFournisseur = $this->createForm(new AddFournisseurType($this->generateUrl('ic_administration_fournisseur_add')));
        
        if ($formFournisseur->handleRequest($request)->isValid())
        {
            $data = $request->get('formAddFournisseurType');
            
            $typeProduit = $em->getRepository('ICAdministrationBundle:TypeProduit')->find($data['type']);
            
            $fournisseur = new Fournisseur();
            
            $fournisseur->setNom($data['nom']);
            $fournisseur->setContact($data['contact']);
            $fournisseur->setEmail($data['email']);
            $fournisseur->setNumero($data['numero']);
            $fournisseur->setSite($data['site']);
            $fournisseur->setTypeProduit($typeProduit);
            
            $em->persist($fournisseur);
            $em->flush($fournisseur);     
        }

        return $this->redirectToRoute('ic_administration_affichage_fournisseur');
    }
    
    public function updateFournisseurAction(Request $request,$idFournisseur)
    {
        $em = $this->getDoctrine()->getManager();

        $formFournisseur = $this->createForm(new UpdateFournisseurType($this->generateUrl('ic_administration_fournisseur_update', array('idFournisseur' => $idFournisseur))));
        
        if ($formFournisseur->handleRequest($request)->isValid())
        {
            $data = $request->get('formUpdateFournisseurType');
            
            $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($idFournisseur); 
            $typeProduit = $em->getRepository('ICAdministrationBundle:TypeProduit')->find($data['type']);   
            
            $fournisseur->setNom($data['nom']);
            $fournisseur->setContact($data['contact']);
            $fournisseur->setEmail($data['email']);
            $fournisseur->setNumero($data['numero']);
            $fournisseur->setSite($data['site']);
            $fournisseur->setType($typeProduit);
            
            $em->flush($fournisseur);     
        }

        return $this->redirectToRoute('ic_administration_affichage_fournisseur');
    }
    
    public function deleteFournisseurAction($idFournisseur)
    {
        $em = $this->getDoctrine()->getManager();
        
        $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($idFournisseur); 
        
        $em->remove($fournisseur);
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_affichage_fournisseur');
    }
}
