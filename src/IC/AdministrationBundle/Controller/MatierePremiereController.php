<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\AdministrationBundle\Form\Type\AddComposantFournisseurType;
use IC\AdministrationBundle\Form\Type\AddComposantType;
use IC\AdministrationBundle\Form\Type\UpdateComposantType;
use IC\AdministrationBundle\Form\Type\UpdateComposantFournisseurType;
use Symfony\Component\HttpFoundation\Response;

class MatierePremiereController extends Controller
{
    public function affichageMatierePremiereAction(request $request)
    {       
        $em = $this->getDoctrine()->getManager();
        
        //Partie Recherche et trie des composants
        if('POST' == $request->getMethod())
        {
            //recheche basique par composant
            $listComposant = $em->getRepository('ICAdministrationBundle:Composant')->getStockByCritere($_POST['formComposantInterne']);
        }
        else
            $listComposant = $em->getRepository('ICAdministrationBundle:Composant')->findAll();
        
        $formComposant = $this->createForm(new AddComposantType($this->generateUrl('ic_administration_mp_add')));
        
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('partie' => 'Administration',
                                                                                    'form' => $formComposant->createView(),
                                                                                    'composants' => $listComposant));
    }
    
    public function affichageMatierePremiereDetailAction($idComposant, $idComposantFournisseur, $page)
    {  
        $em = $this->getDoctrine()->getManager();
        
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->find($idComposant);
        $listComposantFournisseur = $em->getRepository('ICAdministrationBundle:ComposantFournisseur')->getListComposantById($idComposant);     
        
        if($page == 'Modification')
        {
            $composantFournisseur = $em->getRepository('ICAdministrationBundle:ComposantFournisseur')->Find($idComposantFournisseur);
            $formUpdateComposantFournisseur = $this->createForm(new UpdateComposantFournisseurType($this->generateUrl('ic_administration_composant_fournisseur_update', array('idComposantFournisseur' => $idCompsoantFournisseur))), $composantFournisseur)->createView();
        }
        else
            $formUpdateComposantFournisseur = null;

        
        $formUpdateComposant = $this->createForm(new UpdateComposantType($this->generateUrl('ic_administration_mp_update', array('idComposant' => $idComposant))), $composant)->createView();
        $formAddComposantFournisseur = $this->createForm(new AddComposantFournisseurType($this->generateUrl('ic_administration_mp_add')))->createView();
         
        return $this->render('ICAdministrationBundle:MP:affichageDetail.html.twig', array('partie' => 'Administration', 
                                                                                          'form' => $formUpdateComposant,
                                                                                          'form1' => $formAddComposantFournisseur,
                                                                                          'form2' => $formUpdateComposantFournisseur,
                                                                                          'idComposantFournisseur' => $idComposantFournisseur,
                                                                                          'composantsFournisseur' => $listComposantFournisseur));
    }
    
    public function addMatierePremiereAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }

    public function updateMatierePremiereAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function deleteMatierePremiereAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function addComposantFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function updateComposantFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function deleteComposantFournisseurAction()
    {
        return $this->render('ICAdministrationBundle:MP:affichage.html.twig', array('name' => 'test'));        
    }
    
    public function choixFamilleAction(request $request, $idFamille)
    {      
        $em = $this->getDoctrine()->getManager();
        $req = '';
        
        $sousFamille = $em->getRepository('ICAdministrationBundle:SousFamille')->getSousFamilleByIdFamille($idFamille);
        
        foreach ($sousFamille as $sFamille) 
        {
            $req .= '<option value="'.$sFamille->getId().'" >'.$sFamille->getNom().'</option>';
        }
        
        return new Response($req);
    }
}
