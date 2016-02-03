<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\AdministrationBundle\Form\Type\LecteurType;
use IC\AdministrationBundle\Form\Type\IdentifiantType;
use IC\AdministrationBundle\Form\Type\LecteurAutreType;
use IC\AdministrationBundle\Form\Type\AutreType;
use IC\AdministrationBundle\Entity\TypeLecteur;
use IC\AdministrationBundle\Entity\TypeLecteurAutre;
use IC\AdministrationBundle\Entity\TypeBadge;
use IC\AdministrationBundle\Entity\Autre;

class ProduitFiniController extends Controller
{
    public function affichageProduitFiniLecteurInterneAction($idTypeLecteur)
    {
        $em = $this->getDoctrine()->getManager();
        
        $listTypeLecteur = $em->getRepository('ICAdministrationBundle:TypeLecteur')->getAllTypeLecteur();
        
        if($idTypeLecteur == 0)
            $formTypeLecteur = $this->createForm(new LecteurType($this->generateUrl('ic_administration_type_lecteur_add')));
        else
        {
            $typeLecteur = $em->getRepository('ICAdministrationBundle:TypeLecteur')->getTypeById($idTypeLecteur);
            $formTypeLecteur = $this->createForm(new LecteurType($this->generateUrl('ic_administration_type_lecteur_update', array('idTypeLecteur' => $idTypeLecteur))), $typeLecteur[0]);
        }
        
        return $this->render('ICAdministrationBundle:PF:affichageLecteur.html.twig', array('partie' => 'Administration',
                                                                                           'form' => $formTypeLecteur->createView(),
                                                                                           'idTypeLecteur' => $idTypeLecteur,
                                                                                           'typeLecteur' => $listTypeLecteur));
    }
    
    public function addProduitFiniLecteurInterneAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $formTypeLecteur = $this->createForm(new LecteurType);

        if ($formTypeLecteur->handleRequest($request)->isValid())
        {
            $data = $request->get('formTypeLecteurType');
            
            $nomenclature = $em->getRepository('ICAdministrationBundle:Nomenclature')->find($data['nomenclature']);   
            $type = $em->getRepository('ICAdministrationBundle:SousTypeLecteur')->find($data['sousTypeLecteur']);                      

            $typeLecteur = new TypeLecteur();
            
            $typeLecteur->setNomenclature($nomenclature);
            $typeLecteur->setDesignation($data['designation']);
            $typeLecteur->setFrequence($data['frequence']);
            $typeLecteur->setSousTypeLecteur($type);
            $typeLecteur->setPetite($data['petite']);
            $typeLecteur->setMoyenne($data['moyenne']);
            $typeLecteur->setGrande($data['grande']);
            
            $em->persist($typeLecteur);
            $em->flush($typeLecteur);     
        }
         
        return $this->redirectToRoute('ic_administration_affichage_produit_fini_lecteur_interne');    
    }
        
    public function updateProduitFiniLecteurInterneAction(request $request, $idTypeLecteur)
    {
        $em = $this->getDoctrine()->getManager();

        $formTypeLecteur = $this->createForm(new LecteurType);
        
        if ($formTypeLecteur->handleRequest($request)->isValid())
        {
            $data = $request->get('formTypeLecteurType');
            
            $nomenclature = $em->getRepository('ICAdministrationBundle:Nomenclature')->find($data['nomenclature']);   
            $type = $em->getRepository('ICAdministrationBundle:SousTypeLecteur')->find($data['sousTypeLecteur']);                      
            
            $typeLecteur = $em->getRepository('ICAdministrationBundle:TypeLecteur')->find($idTypeLecteur);
            
            $typeLecteur->setNomenclature($nomenclature);
            $typeLecteur->setDesignation($data['designation']);
            $typeLecteur->setFrequence($data['frequence']);
            $typeLecteur->setSousTypeLecteur($type);
            $typeLecteur->setPetite($data['petite']);
            $typeLecteur->setMoyenne($data['moyenne']);
            $typeLecteur->setGrande($data['grande']);
            
            $em->persist($typeLecteur);
            $em->flush($typeLecteur);
        }
        
        return $this->redirectToRoute('ic_administration_affichage_produit_fini_lecteur_interne');         
    }
    
    public function affichageIdentifiantAction($idIdentifiant)
    {        
        $em = $this->getDoctrine()->getManager();
        
        $listTypeIdentifiant = $em->getRepository('ICAdministrationBundle:TypeBadge')->getAllTypeIdentifiant();
        
        if($idIdentifiant == 0)
            $formTypeIdentifiant = $this->createForm(new IdentifiantType($this->generateUrl('ic_administration_identifiant_add')));
        else
        {
            $identifiant = $em->getRepository('ICAdministrationBundle:TypeBadge')->find($idIdentifiant);
            $formTypeIdentifiant = $this->createForm(new IdentifiantType($this->generateUrl('ic_administration_identifiant_update', array('idIdentifiant' => $idIdentifiant))), $identifiant);
        }
        
        return $this->render('ICAdministrationBundle:PF:affichageIdentifiant.html.twig', array('partie' => 'Administration',
                                                                                               'form' => $formTypeIdentifiant->createView(),
                                                                                               'idIdentifiant' => $idIdentifiant,
                                                                                               'typeIdentifiant' => $listTypeIdentifiant));       
    }
    
    public function addIdentifiantAction(request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $formIdentifiant = $this->createForm(new IdentifiantType);

        if ($formIdentifiant->handleRequest($request)->isValid())
        {
            $data = $request->get('identifiantType');
              
            $type = $em->getRepository('ICAdministrationBundle:SousTypeBadge')->find($data['sousTypeBadge']);                      
            $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['idFournisseur']); 
            
            $typeBadge = new TypeBadge();
            
            $typeBadge->setReference($data['reference']);
            $typeBadge->setDesignation($data['designation']);
            $typeBadge->setFrequence($data['frequence']);
            $typeBadge->setSousTypeBadge($type);
            $typeBadge->setFournisseur($fournisseur);
            
            $em->persist($typeBadge);
            $em->flush($typeBadge);     
        }
        
        return $this->redirectToRoute('ic_administration_affichage_produit_fini_identifiant_interne');          
    }
    
    public function updateIdentifiantAction(request $request, $idIdentifiant)
    {
        $em = $this->getDoctrine()->getManager();

        $formIdentifiant = $this->createForm(new IdentifiantType);

        if ($formIdentifiant->handleRequest($request)->isValid())
        {
            $data = $request->get('identifiantType');
              
            $type = $em->getRepository('ICAdministrationBundle:SousTypeBadge')->find($data['sousTypeBadge']);                      
            $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['idFournisseur']); 
            
            $typeBadge = $em->getRepository('ICAdministrationBundle:TypeBadge')->find($idIdentifiant); 
            
            $typeBadge->setReference($data['reference']);
            $typeBadge->setDesignation($data['designation']);
            $typeBadge->setFrequence($data['frequence']);
            $typeBadge->setSousTypeBadge($type);
            $typeBadge->setFournisseur($fournisseur);
                        
            $em->persist($typeBadge);
            $em->flush($typeBadge);     
        }
        
        return $this->redirectToRoute('ic_administration_affichage_produit_fini_identifiant_interne');         
    }
    
    public function affichageAutreAction($idAutre, $idType)
    {
        $em = $this->getDoctrine()->getManager();
        
        $listLecteurAutre = $em->getRepository('ICAdministrationBundle:TypeLecteurAutre')->getAllLecteurAutre();
        $listAutre = $em->getRepository('ICAdministrationBundle:Autre')->getAllAutre();
        
        if($idAutre == 0)
        {
            $formLecteurAutre = $this->createForm(new LecteurAutreType($this->generateUrl('ic_administration_autre_add', array('idType' => 1))));
            $formAutre = $this->createForm(new AutreType($this->generateUrl('ic_administration_autre_add', array('idType' => 2))));
        }      
        else
        {
            if($idType == 1)
            {
                $lecteurAutre = $em->getRepository('ICAdministrationBundle:TypeLecteurAutre')->find($idAutre);
                $formLecteurAutre = $this->createForm(new LecteurAutreType($this->generateUrl('ic_administration_autre_update', array('idAutre' => $idAutre, 'idType' => $idType))), $lecteurAutre);
                $formAutre = $this->createForm(new AutreType($this->generateUrl('ic_administration_autre_add', array('idType' => 2))));
            }
            else
            {
                $autre = $em->getRepository('ICAdministrationBundle:Autre')->find($idAutre);
                $formLecteurAutre = $this->createForm(new LecteurAutreType($this->generateUrl('ic_administration_autre_add', array('idType' => 1))));
                $formAutre = $this->createForm(new AutreType($this->generateUrl('ic_administration_autre_update', array('idAutre' => $idAutre, 'idType' => $idType))), $autre);
            }
        }
        
        return $this->render('ICAdministrationBundle:PF:affichageAutre.html.twig', array('partie' => 'Administration',
                                                                                         'form' => $formLecteurAutre->createView(),
                                                                                         'form1' => $formAutre->createView(),
                                                                                         'idType' => $idType,
                                                                                         'idAutre' => $idAutre,
                                                                                         'lecteurAutre' => $listLecteurAutre,
                                                                                         'autre' => $listAutre));        
    }
    
    public function addAutreAction(request $request, $idType)
    {
        if($idType == 1)
        {
            $em = $this->getDoctrine()->getManager();

            $formLecteurAutre = $this->createForm(new LecteurAutreType);

            if ($formLecteurAutre->handleRequest($request)->isValid())
            {
                $data = $request->get('lecteurAutreType');
                
                $type = $em->getRepository('ICAdministrationBundle:SousTypeLecteur')->find($data['sousTypeLecteur']);                      
                $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['idFournisseur']);  

                $typeLecteurAutre = new TypeLecteurAutre();
                
                $typeLecteurAutre->setReference($data['reference']);
                $typeLecteurAutre->setDesignation($data['designation']);
                $typeLecteurAutre->setFrequence($data['frequence']);
                $typeLecteurAutre->setSousTypeLecteur($type);
                $typeLecteurAutre->setFournisseur($fournisseur);
                $typeLecteurAutre->setPetite($data['petite']);
                $typeLecteurAutre->setMoyenne($data['moyenne']);
                $typeLecteurAutre->setGrande($data['grande']);
                
                $em->persist($typeLecteurAutre);
                $em->flush($typeLecteurAutre);     
            }             
        }
        else
        {
            $em = $this->getDoctrine()->getManager();

            $formAutre = $this->createForm(new AutreType);

            if ($formAutre->handleRequest($request)->isValid())
            {
                $data = $request->get('autreType');
                
                $type = $em->getRepository('ICAdministrationBundle:TypeAutre')->find($data['typeAutre']);                      
                $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['idFournisseur']); 
                
                $typeAutre = new Autre();
                
                $typeAutre->setReference($data['reference']);
                $typeAutre->setDesignation($data['designation']);
                $typeAutre->setQuantite(0);
                $typeAutre->setTypeAutre($type);
                $typeAutre->setFournisseur($fournisseur);
                
                $em->persist($typeAutre);
                $em->flush($typeAutre);     
            }                
        }
        
        return $this->redirectToRoute('ic_administration_affichage_produit_fini_autre_interne');  
    }
    
    public function updateAutreAction(request $request, $idAutre, $idType)
    {
        if($idType == 1)
        {
            $em = $this->getDoctrine()->getManager();

            $formLecteurAutre = $this->createForm(new LecteurAutreType);

            if ($formLecteurAutre->handleRequest($request)->isValid())
            {
                $data = $request->get('lecteurAutreType');
                
                $type = $em->getRepository('ICAdministrationBundle:SousTypeLecteur')->find($data['sousTypeLecteur']);                      

                $typeLecteurAutre = $em->getRepository('ICAdministrationBundle:TypeLecteurAutre')->find($idAutre); 
                $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['idFournisseur']);
                
                $typeLecteurAutre->setReference($data['reference']);
                $typeLecteurAutre->setDesignation($data['designation']);
                $typeLecteurAutre->setFrequence($data['frequence']);
                $typeLecteurAutre->setSousTypeLecteur($type);
                $typeLecteurAutre->setFournisseur($fournisseur);
                $typeLecteurAutre->setPetite($data['petite']);
                $typeLecteurAutre->setMoyenne($data['moyenne']);
                $typeLecteurAutre->setGrande($data['grande']);
                
                $em->persist($typeLecteurAutre);
                $em->flush($typeLecteurAutre);     
            }             
        }
        else
        {
            $em = $this->getDoctrine()->getManager();

            $formAutre = $this->createForm(new AutreType);

            if ($formAutre->handleRequest($request)->isValid())
            {
                $data = $request->get('autreType');
                
                $type = $em->getRepository('ICAdministrationBundle:TypeAutre')->find($data['typeAutre']);                      
                $fournisseur = $em->getRepository('ICAdministrationBundle:Fournisseur')->find($data['idFournisseur']);
                
                $typeAutre = $em->getRepository('ICAdministrationBundle:Autre')->find($idAutre); 
                
                $typeAutre->setReference($data['reference']);
                $typeAutre->setDesignation($data['designation']);
                $typeAutre->setQuantite(0);
                $typeAutre->setTypeAutre($type);
                $typeAutre->setFournisseur($fournisseur);
                
                $em->persist($typeAutre);
                $em->flush($typeAutre);     
            }                
        }
        
        return $this->redirectToRoute('ic_administration_affichage_produit_fini_autre_interne');         
    }
}
