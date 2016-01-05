<?php

namespace IC\ApprovisionnementBundle\Classes;
use Doctrine\ORM\EntityManager;

class ICApprovisionnementProduction
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
                //si le composant fais parti des composant a envoyé au sous traitan ou si la production se fais en interne
                if(in_array($composantNomenclature->getIdComposant(), $listComposantUtilise) || $production->getIdLieu() == 0)
                {
                    //au premier tour de boucle on créé le premier champ du tableau
                    if(!isset($quantiteCommande['idComposant'][0]))
                    {
                        $quantiteCommande['idComposant'][] = $composantNomenclature->getIdComposant();
                        $quantiteCommande['quantite'][] = $composantNomenclature->getComposant()->getStockInterne() - ($composantNomenclature->getQuantite() * $production->getQuantite());
                    }
                    else
                    {
                        $existe = 0;
                        //vérification si le composant a déja été renseigner pour une autre nomenclature
                        for($i = 0; $i < count($quantiteCommande['idComposant']); $i++)
                        {
                            //si il l'a été on ajoute simplement la quantité à celle existante
                            if($quantiteCommande['idComposant'][$i] == $composantNomenclature->getIdComposant())
                            {
                                $existe = 1;
                                $quantiteCommande['quantite'][$i] -= $composantNomenclature->getQuantite() * $production->getQuantite();
                            }
                        }
                        
                        //si il n'existe pas on le créé
                        if($existe == 0)
                        {
                            $quantiteCommande['idComposant'][] = $composantNomenclature->getIdComposant();
                            $quantiteCommande['quantite'][] = $composantNomenclature->getComposant()->getStockInterne() - ($composantNomenclature->getQuantite() * $production->getQuantite());                            
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
                                if(!isset($composantStockST['idComposant'][0]))
                                {
                                    $composantStockST['lieu'][] = $production->getIdLieu();
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
    
    public function ajoutStockST($composantStockST, $quantiteCommande)
    {
        for($i = 0; $i < count($composantStockST['idComposant']); $i++)
        {
            for($i1 = 0; $i1 < count($quantiteCommande['idComposant']); $i1++) 
            {
                if($quantiteCommande['idComposant'][$i1] == $composantStockST['idComposant'][$i])
                {
                    $quantiteCommande['quantite'][$i1] += $composantStockST['quantite'][$i]; 
                }
            }
        }
        return $quantiteCommande;
    }  
    
    public function verifStockCommande($quantiteCommande)
    {
        for($i = 0; $i < count($quantiteCommande['quantite']); $i++)
        {
            if($quantiteCommande['quantite'][$i] > 0)
            {
                unset($quantiteCommande['idComposant'][$i]);
                unset($quantiteCommande['quantite'][$i]);
                $quantiteCommande['idComposant'] = array_values($quantiteCommande['idComposant']); 
                $quantiteCommande['quantite'] = array_values($quantiteCommande['quantite']); 
            }
        }
        return $quantiteCommande;        
    }
}