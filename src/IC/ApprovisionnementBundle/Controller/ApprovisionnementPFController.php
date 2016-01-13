<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\ApprovisionnementBundle\Entity\Appro;
use IC\ApprovisionnementBundle\Entity\ApproIdentifiant;
use IC\ApprovisionnementBundle\Entity\ApproAutre;
use IC\ApprovisionnementBundle\Entity\ApproLecteur;

class ApprovisionnementPFController extends Controller
{
    public function approProduitsFinisIdentifiantsAction()
    {       
        $em = $this->getDoctrine()->getManager();
        
        $identifiant = $em->getRepository('ICApprovisionnementBundle:Badge')->getAllBadge();
        
        return $this->render('ICApprovisionnementBundle:PF:identifiant.html.twig', array('partie' => 'approvisionnement', 'identifiant' => $identifiant));
    }
    
    public function approProduitsFinisAutresAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $typeLecteur = $em->getRepository('ICApprovisionnementBundle:TypeLecteur')->getAllTypeLecteur();
        $autre = $em->getRepository('ICApprovisionnementBundle:Autre')->getAllAutre();
        
        return $this->render('ICApprovisionnementBundle:PF:autre.html.twig', array('partie' => 'approvisionnement', 
                                                                                   'typeLecteur' => $typeLecteur,
                                                                                   'autre' => $autre));
    }
    
    public function calculApproIdentifiantAction(request $request, $idFournisseur)
    {
        if($request->get('option') != null)
        {
            $em = $this->getDoctrine()->getManager();
            
            $fournisseur = $em->getRepository('ICApprovisionnementBundle:Fournisseur')->findOneBy(array('id' => $idFournisseur));
            
            $appro = new Appro();
            $appro->setFournisseur($fournisseur);
            $appro->setTypeProduit(2);
            $appro->setDateCommande(new \Datetime());
            
            $em->persist($appro);
            $em->flush();  
                
            $lastAppro = $em->getRepository('ICApprovisionnementBundle:Appro')->getLastAppro();
            $lastAppro = $em->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $lastAppro[0]->getId()));
        
            foreach ($request->get('option') as $idBadge) 
            {    
                if($request->get($idBadge) != null)
                {
                    $badge = $em->getRepository('ICApprovisionnementBundle:Badge')->findOneBy(array('id' => $idBadge));
                    
                    
                    $composantAppro = new ApproIdentifiant();
                    $composantAppro->setBadge($badge);
                    $composantAppro->setQuantite($request->get($idBadge));
                    $composantAppro->setAppro($lastAppro);
                    
                    $em->persist($composantAppro);                    
                }
            }
            $em->flush();     
        }
        return $this->redirectToRoute('ic_approvisionnement_pf_identifiant');
    }
    
    public function calculApproAutreAction(request $request, $idFournisseur)
    {
        if($request->get('option') != null)
        {
            $em = $this->getDoctrine()->getManager();
            
            $fournisseur = $em->getRepository('ICApprovisionnementBundle:Fournisseur')->findOneBy(array('id' => $idFournisseur));
                
            $appro = new Appro();
            $appro->setFournisseur($fournisseur);
            $appro->setTypeProduit($fournisseur->getType());
            $appro->setDateCommande(new \Datetime());
            
            $em->persist($appro);
            $em->flush();
                
            $lastAppro = $em->getRepository('ICApprovisionnementBundle:Appro')->getLastAppro();
            $lastAppro = $em->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $lastAppro[0]->getId()));
            
            if($fournisseur->getType() == 4)
            {
                foreach ($request->get('option') as $idAutre) 
                {
                    $autre = $em->getRepository('ICApprovisionnementBundle:Autre')->findOneBy(array('id' => $idAutre));

                    $approAutre = new ApproAutre();
                    $approAutre->setAutre($autre);
                    $approAutre->setQuantite($request->get($idAutre));
                    $approAutre->setAppro($lastAppro);
                       
                    $em->persist($approAutre);            
                }
            }
            elseif($fournisseur->getType() == 3)
            {
                foreach ($request->get('option') as $idLecteur) 
                {
                    $typeLecteur = $em->getRepository('ICApprovisionnementBundle:TypeLecteur')->findOneBy(array('id' => $idLecteur));
                    echo $idLecteur;
                    $approLecteur = new ApproLecteur();
                    $approLecteur->setTypeLecteur($typeLecteur);
                    $approLecteur->setQuantite($request->get($idLecteur));
                    $approLecteur->setAppro($lastAppro);
                       
                    $em->persist($approLecteur);            
                }                
            }
            
            $em->flush();
        }
        return $this->redirectToRoute('ic_approvisionnement_pf_autre');
    }    
}
