<?php

namespace IC\ApprovisionnementBundle\Classes;
use Doctrine\ORM\EntityManager;
use IC\ApprovisionnementBundle\Entity\Appro;
use IC\ApprovisionnementBundle\Entity\ApproIdentifiant;
use IC\ApprovisionnementBundle\Entity\ApproAutre;
use IC\ApprovisionnementBundle\Entity\ApproLecteur;

class ICApprovisionnementPF
{
    protected $doctrine;
    
    public function __construct(EntityManager $doctrine)
    {      
        $this->doctrine = $doctrine;
    }
    
    public function addApproIdentifiant($request, $idFournisseur)
    {
        if($request->get('option') != null)
        {
            $doctrine = $this->doctrine;
            
            $fournisseur = $doctrine->getRepository('ICApprovisionnementBundle:Fournisseur')->findOneBy(array('id' => $idFournisseur));
            
            $appro = new Appro();
            $appro->setFournisseur($fournisseur);
            $appro->setTypeProduit(2);
            $appro->setDateCommande(new \Datetime());
            
            $doctrine->persist($appro);
            $doctrine->flush();  
                
            $lastAppro = $doctrine->getRepository('ICApprovisionnementBundle:Appro')->getLastAppro();
        
            foreach ($request->get('option') as $idBadge) 
            {    
                if($request->get($idBadge) != null)
                {
                    $badge = $doctrine->getRepository('ICApprovisionnementBundle:Badge')->findOneBy(array('id' => $idBadge));
                    
                    
                    $composantAppro = new ApproIdentifiant();
                    $composantAppro->setBadge($badge);
                    $composantAppro->setQuantite($request->get($idBadge));
                    $composantAppro->setAppro($lastAppro[0]);
                    
                    $doctrine->persist($composantAppro);                    
                }
            }
            $doctrine->flush();     
        }
    }
    public function addApproAutre($request, $idFournisseur)
    {
        if($request->get('option') != null)
        {
            $doctrine = $this->doctrine;
            
            $fournisseur = $doctrine->getRepository('ICApprovisionnementBundle:Fournisseur')->findOneBy(array('id' => $idFournisseur));
                
            $appro = new Appro();
            $appro->setFournisseur($fournisseur);
            $appro->setTypeProduit($fournisseur->getType());
            $appro->setDateCommande(new \Datetime());
            
            $doctrine->persist($appro);
            $doctrine->flush();
                
            $lastAppro = $doctrine->getRepository('ICApprovisionnementBundle:Appro')->getLastAppro();
            
            if($fournisseur->getType() == 4)
            {
                foreach ($request->get('option') as $idAutre) 
                {
                    $autre = $doctrine->getRepository('ICApprovisionnementBundle:Autre')->findOneBy(array('id' => $idAutre));

                    $approAutre = new ApproAutre();
                    $approAutre->setAutre($autre);
                    $approAutre->setQuantite($request->get($idAutre));
                    $approAutre->setAppro($lastAppro[0]);
                       
                    $doctrine->persist($approAutre);            
                }
            }
            elseif($fournisseur->getType() == 3)
            {
                foreach ($request->get('option') as $idLecteur) 
                {
                    $typeLecteur = $doctrine->getRepository('ICApprovisionnementBundle:TypeLecteurAutre')->findOneBy(array('id' => $idLecteur));

                    $approLecteur = new ApproLecteur();
                    $approLecteur->setTypeLecteurAutre($typeLecteur);
                    $approLecteur->setQuantite($request->get($idLecteur));
                    $approLecteur->setAppro($lastAppro[0]);
                       
                    $doctrine->persist($approLecteur);            
                }                
            }
            
            $doctrine->flush();
        }        
    }
}