<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use IC\AdministrationBundle\Form\Type\AddComposantFournisseurType;
use IC\AdministrationBundle\Form\Type\AddComposantType;
use IC\AdministrationBundle\Form\Type\UpdateComposantType;
use IC\AdministrationBundle\Form\Type\UpdateComposantFournisseurType;
use IC\AdministrationBundle\Entity\ComposantFournisseur;
use IC\AdministrationBundle\Entity\Composant;


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
            $composantFournisseur = $em->getRepository('ICAdministrationBundle:ComposantFournisseur')->find($idComposantFournisseur);
            $formUpdateComposantFournisseur = $this->createForm(new UpdateComposantFournisseurType($this->generateUrl('ic_administration_composant_fournisseur_update', array('idComposantFournisseur' => $idComposantFournisseur))), $composantFournisseur)->createView();
        }
        else
            $formUpdateComposantFournisseur = null;

        
        $formUpdateComposant = $this->createForm(new UpdateComposantType($this->generateUrl('ic_administration_mp_update', array('idComposant' => $idComposant))), $composant)->createView();
        $formAddComposantFournisseur = $this->createForm(new AddComposantFournisseurType($this->generateUrl('ic_administration_composant_fournisseur_add', array('idComposant' => $idComposant))))->createView();
         
        return $this->render('ICAdministrationBundle:MP:affichageDetail.html.twig', array('partie' => 'Administration', 
                                                                                          'form' => $formUpdateComposant,
                                                                                          'form1' => $formAddComposantFournisseur,
                                                                                          'form2' => $formUpdateComposantFournisseur,
                                                                                          'idComposantFournisseur' => $idComposantFournisseur,
                                                                                          'composantsFournisseur' => $listComposantFournisseur));
    }
    
    public function addMatierePremiereAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $formComposant = $this->createForm(new AddComposantType($this->generateUrl('ic_administration_mp_add')));
        
        if ($formComposant->handleRequest($request)->isValid())
        {
            $data = $request->get('formComposant');
            
            $famille = $em->getRepository('ICAdministrationBundle:Famille')->find($data['famille']);   
            $sousFamille = $em->getRepository('ICAdministrationBundle:SousFamille')->find($data['sousFamille']);                      

            $composant = new Composant();
            
            $composant->setNom($data['nom']);
            $composant->setBoitier($data['boitier']);
            $composant->setStockMini($data['stockMini']);
            $composant->setStockInterne(0);
            $composant->setFamille($famille);
            $composant->setSousFamille($sousFamille);
            
            $em->persist($composant);
            $em->flush($composant);     
        }
        
        return $this->redirectToRoute('ic_administration_matiere_premiere');
    }

    public function updateMatierePremiereAction(request $request, $idComposant)
    {
        $em = $this->getDoctrine()->getManager();
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->find($idComposant); 
        $formComposant = $this->createForm(new UpdateComposantType($this->generateUrl('ic_administration_mp_add')), $composant);
        
        if ($formComposant->handleRequest($request)->isValid())
        {
            $data = $request->get('formComposant');
    
            $famille = $em->getRepository('ICAdministrationBundle:Famille')->find($data['famille']);   
            $sousFamille = $em->getRepository('ICAdministrationBundle:SousFamille')->find($data['sousFamille']);
            
            $composant->setNom($data['nom']);
            $composant->setBoitier($data['boitier']);
            $composant->setStockMini($data['stockMini']);
            $composant->setStockInterne(0);
            $composant->setFamille($famille);
            $composant->setSousFamille($sousFamille);
            
            $em->persist($composant);
            $em->flush($composant);     
        }
        
        return $this->redirectToRoute('ic_administration_mp_detail', array('idComposant' => $idComposant));
    }
    
    public function deleteMatierePremiereAction($idComposant)
    { 
        $em = $this->getDoctrine()->getManager();
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->find($idComposant); 
        
        $em->remove($composant);
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_matiere_premiere');
    }
    
    public function addComposantFournisseurAction(request $request, $idComposant)
    {
       $em = $this->getDoctrine()->getManager();

        $formComposantFournisseur = $this->createForm(new AddComposantFournisseurType);
        
        if ($formComposantFournisseur->handleRequest($request)->isValid())
        {
            $data = $request->get('formAddComposantFournisseurType');

            $composant = $em->getRepository('ICAdministrationBundle:Composant')->find($idComposant);   
            $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['fournisseur']);
            
            $composantFournisseur = new ComposantFournisseur();
            
            $composantFournisseur->setReference($data['reference']);
            $composantFournisseur->setPrix($data['prix']);
            $composantFournisseur->setComposant($composant);
            $composantFournisseur->setFournisseur($fournisseur);
            
            $em->persist($composantFournisseur);
            $em->flush($composantFournisseur);     
        }
        
        return $this->redirectToRoute('ic_administration_mp_detail', array('idComposant' => $idComposant));
    }
    
    public function updateComposantFournisseurAction(request $request, $idComposantFournisseur)
    {
        $em = $this->getDoctrine()->getManager();
        $composantFournisseur = $em->getRepository('ICAdministrationBundle:ComposantFournisseur')->find($idComposantFournisseur);
        $formComposantFournisseur = $this->createForm(new UpdateComposantFournisseurType($this->generateUrl('ic_administration_mp_add')), $composantFournisseur);
        
        if ($formComposantFournisseur->handleRequest($request)->isValid())
        {
            $data = $request->get('formUpdateComposantFournisseurType');
              
            $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['fournisseur']);

            $composantFournisseur->setReference($data['reference']);
            $composantFournisseur->setPrix($data['prix']);
            $composantFournisseur->setFournisseur($fournisseur);
            
            $em->persist($composantFournisseur);
            $em->flush($composantFournisseur);     
        }
        
        return $this->redirectToRoute('ic_administration_mp_detail', array('idComposant' => $composantFournisseur->getComposant()->getId()));
    }
    
    public function deleteComposantFournisseurAction($idComposantFournisseur)
    {

        $em = $this->getDoctrine()->getManager();
        $composantFournisseur = $em->getRepository('ICAdministrationBundle:ComposantFournisseur')->find($idComposantFournisseur); 
        $idComposant = $composantFournisseur->getComposant()->getId();
        
        $em->remove($composantFournisseur);
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_mp_detail', array('idComposant' => $idComposant));        
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
