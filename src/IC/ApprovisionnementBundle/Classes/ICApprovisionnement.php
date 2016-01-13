<?php

namespace IC\ApprovisionnementBundle\Classes;
use Doctrine\ORM\EntityManager;
use IC\ApprovisionnementBundle\Entity\Appro;
use IC\ApprovisionnementBundle\Entity\ApproComposant;

class ICApprovisionnement
{
    protected $doctrine;
    
    public function __construct(EntityManager $doctrine)
    {      
        $this->doctrine = $doctrine;
    }
    
    public function calculApproProd()
    {
        $doctrine = $this->doctrine;
        
        $listProduction = $doctrine->getRepository('ICApprovisionnementBundle:Production')->getListProdEnAttente();
        
        foreach($listProduction as $production)
        {
            $listComposantNomenclature = $doctrine->getRepository('ICApprovisionnementBundle:ComposantNomenclature')->getComposantNomenclature($production->getIdNomenclature());
            $listComposantSousTraitant = $doctrine->getRepository('ICApprovisionnementBundle:ComposantSousTraitant')->getComposantSt($production->getIdLieu());
            $listComposantUtilise = explode(',', $production->getComposantUtilise());
            
            foreach($listComposantNomenclature as $composantNomenclature)
            {   
                //si le composant fais parti des composants à envoyé au sous traitant ou si la production se fais en interne
                if(in_array($composantNomenclature->getIdComposant(), $listComposantUtilise) || $production->getIdLieu() == 0)
                {
                    //au premier tour de boucle on créé le premier champ du tableau
                    if(!isset($quantiteCommande[0]['idComposant']))
                    {
                        $quantiteCommande[0]['idComposant'] = $composantNomenclature->getIdComposant();
                        $quantiteCommande[0]['quantite'] = $composantNomenclature->getComposant()->getStockInterne() - ($composantNomenclature->getQuantite() * $production->getQuantite());
                    }
                    else
                    {
                        $existe = 0;
                        //vérification si le composant a déja été renseigner pour une autre nomenclature
                        for($i = 0; $i < count($quantiteCommande); $i++)
                        {
                            //si il l'a été on ajoute simplement la quantité à celle existante
                            if($quantiteCommande[$i]['idComposant'] == $composantNomenclature->getIdComposant())
                            {
                                $existe = 1;
                                $quantiteCommande[$i]['quantite'] -= $composantNomenclature->getQuantite() * $production->getQuantite();
                            }
                        }
                        
                        //si il n'existe pas on le créé
                        if($existe == 0)
                        {
                            $next = count($quantiteCommande);
                            $quantiteCommande[$next]['idComposant'] = $composantNomenclature->getIdComposant();
                            $quantiteCommande[$next]['quantite'] = $composantNomenclature->getComposant()->getStockInterne() - ($composantNomenclature->getQuantite() * $production->getQuantite());                            
                        }
                    }
                    $composantStockST = array();
                    //ajout de la quantité du stock sous traitant à additionner au stock à commander
                    if(in_array($composantNomenclature->getIdComposant(), $listComposantUtilise))
                    {
                        foreach($listComposantSousTraitant as $composantSousTraitant)
                        {
                            //on vérifie que le composant existe en stock chez le sous traitant
                            if($composantSousTraitant->getIdComposant() == $composantNomenclature->getIdComposant())
                            {
                                //au premier tour de boucle on créé le premier champ du tableau
                                if(!isset($composantStockST[0]['idComposant']))
                                {
                                    $composantStockST['lieu'] = $production->getIdLieu();
                                    $composantStockST['idComposant'][] = $composantSousTraitant->getIdComposant();
                                    $composantStockST['quantite'][] = $composantSousTraitant->getQuantite();
                                }
                                else
                                {
                                    $existe = 0;
                                    
                                    for($i = 0; $i < count($composantStockST['idComposant']); $i++)
                                    {
                                        //on vérifie que le composant n'existe pas déja chez un autre sous traitant sinon on l'ajoute a celui ci 
                                        //on vérifie que l'on ne fais pas de doublon en comparant que le sous traitant actuel est différent du sous traitant enregistré
                                        if($composantStockST['idComposant'][$i] == $composantNomenclature->getIdComposant() && $composantStockST['lieu'][$i] != $production->getIdLieu())
                                        {
                                            $existe = 1;
                                            $composantStockST['lieu'][] = $production->getIdLieu();
                                            $composantStockST['quantite'][$i] += $composantSousTraitant->getQuantite();
                                        }
                                    }
                                    //si il n'existe pas on le créé
                                    if($existe == 0)
                                    {
                                        $composantStockST['lieu'][] = $production->getIdLieu();
                                        $composantStockST['idComposant'][] = $composantSousTraitant->getIdComposant();
                                        $composantStockST['quantite'][] = $composantSousTraitant->getQuantite();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return array($quantiteCommande, $composantStockST);
    }
    
    public function calculApproCritique()
    {
        $doctrine = $this->doctrine;
        
        $listComposant = $doctrine->getRepository('ICApprovisionnementBundle:Composant')->findAll();
        
        $i = 0;
        foreach ($listComposant as $composant) {
            if($composant->getStockInterne() < $composant->getStockMini())
            {
                $quantiteCommande[$i]['idComposant'] = $composant->getId();
                $quantiteCommande[$i++]['quantite'] = $composant->getStockInterne() - $composant->getStockMini();
            }
        }
        if(!isset($quantiteCommande))
            $quantiteCommande = array();
            
        return $quantiteCommande;        
    }
    
    public function ajoutStockST($composantStockST, $quantiteCommande)
    {
        for($i = 0; $i < count($composantStockST['idComposant']); $i++)
        {
            for($i1 = 0; $i1 < count($quantiteCommande); $i1++) 
            {
                if($quantiteCommande[$i1]['idComposant'] == $composantStockST['idComposant'][$i])
                {
                    $quantiteCommande[$i1]['quantite'] += $composantStockST['quantite'][$i]; 
                }
            }
        }
        return $quantiteCommande;
    }  
    
    public function ajoutApproEnCour($composantApproEncours, $quantiteCommande)
    {
        foreach($composantApproEncours as $appro)
        {
            for($i = 0; $i < count($quantiteCommande); $i++) 
            {
                if($quantiteCommande[$i]['idComposant'] == $appro->getIdProduit())
                {
                    $quantiteCommande[$i]['quantite'] += $appro->getQuantite(); 
                }
            }
        }    
        return $quantiteCommande;    
    }
    
    public function verifStockCommande($quantiteCommande)
    {        
        $nbQuantiteCommande = count($quantiteCommande);
        
        for($i = 0; $i < $nbQuantiteCommande; $i++)
        {
            if($quantiteCommande[$i]['quantite'] > 0)
                unset($quantiteCommande[$i]);
            else
                $quantiteCommande[$i]['quantite'] = abs($quantiteCommande[$i]['quantite']);
        }
        return array_values($quantiteCommande);        
    }
    
    public function calculAppro($request, $idFournisseur)
    {
        $doctrine = $this->doctrine;
        
        if($request->get('option') != null)
        {
            $fournisseur = $doctrine->getRepository('ICApprovisionnementBundle:Fournisseur')->findOneBy(array('id' => $idFournisseur));

            $appro = new Appro();
            $appro->setFournisseur($fournisseur);
            $appro->setTypeProduit(1);
            $appro->setDateCommande(new \Datetime());
            
            $doctrine->persist($appro);
            $doctrine->flush();  
                
            $lastAppro = $doctrine->getRepository('ICApprovisionnementBundle:Appro')->getLastAppro();
            $lastAppro = $doctrine->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $lastAppro[0]->getId()));
            
            foreach ($request->get('option') as $idMoq) 
            {
                $moq = $doctrine->getRepository('ICApprovisionnementBundle:Moq')->findOneBy(array('id' => $idMoq));
                
                $quantite = $moq->getMoq() * $request->get($moq->getId());
                
                if(!isset($listeComposantAppro['idComposant']))
                {
                    $listeComposantAppro['idComposant'][] = $moq->getIdComposant();
                    $listeComposantAppro['quantite'][] = $quantite;
                }
                else
                {
                    $existe = 0;
                    
                    for($i = 0; $i < count($listeComposantAppro['idComposant']); $i++) 
                    {
                        if($listeComposantAppro['idComposant'][$i] == $moq->getIdComposant())
                        {
                            $existe = 1;
                            $listeComposantAppro['quantite'][$i] += $quantite;
                        }
                    }
                    
                    if($existe == 0)
                    {
                        $listeComposantAppro['idComposant'][] = $moq->getIdComposant();
                        $listeComposantAppro['quantite'][] = $quantite;                    
                    }
                }
            }
            
            for($i = 0; $i < count($listeComposantAppro['idComposant']); $i++) 
            {
                $composant = $doctrine->getRepository('ICApprovisionnementBundle:Composant')->findOneBy(array('id' => $listeComposantAppro['idComposant'][$i]));
                
                $composantAppro = new ApproComposant();
                $composantAppro->setComposant($composant);
                $composantAppro->setQuantite($listeComposantAppro['quantite'][$i]);
                $composantAppro->setAppro($lastAppro);
                
                $doctrine->persist($composantAppro);
            }
            $doctrine->flush();            
        }
    }
}