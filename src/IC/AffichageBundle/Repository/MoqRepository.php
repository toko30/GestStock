<?php

namespace IC\AffichageBundle\Repository;

class MoqRepository extends \Doctrine\ORM\EntityRepository
{
        public function getStockFournisseurByCritere($critere)
        {
                if(!empty($critere['fournisseur']))
                {
                        foreach($critere['fournisseur'] as $fournisseur)
                        {
                                $req = $this->createQueryBuilder('m')
                                ->join('m.fournisseur', 'f')
                                ->join('m.composant', 'c')
                                ->addSelect('c')
                                ->groupBy('m.idComposant')
                                ->where('m.idFournisseur = :id') 
                                ->setParameter('id', $fournisseur);
                                
                                if(!empty($critere['recherche']))
                                {
                                        if($critere['choixRecherche'] == 0)
                                        {
                                                $req->andWhere('c.nom LIKE :nom')
                                                ->setParameter('nom', '%'.trim($critere['recherche'], '#!').'%');                                                
                                        }
                                        else
                                        {
                                                $req->andWhere('m.ref LIKE :ref')
                                                ->setParameter('ref', '%'.trim($critere['recherche'], '#!').'%');      
                                        }
                                }
                                else
                                {
                                         $req->groupBy('m.idComposant');
                                }
                                
                                if(!empty($critere['famille']))
                                {
                                        $req->where('c.idFamille IN (:id)') 
                                        ->setParameter('id', $critere['famille']);
                                }
                                
                                if(!empty($critere['sousFamille']))
                                {
                                        $req->andWhere('c.idSousFamille IN (:id1)') 
                                        ->setParameter('id1', $critere['sousFamille']);
                                }
                                
                                if(!empty($critere['stock']))
                                {
                                        if($critere['plus_ou_moins'] == 0) 
                                                $req->andWhere('c.stockInterne >= :id2');
                                        else
                                                $req->andWhere('c.stockInterne <= :id2');
                                                
                                        $req->setParameter('id2', $critere['stock']);
                                }   
                                $liste[] = $req->getQuery()->getResult();               
                        }  
                        return 	$liste;                      
                }
                else
                {
                        $req = $this->createQueryBuilder('m')
                        ->join('m.fournisseur', 'f')
                        ->join('m.composant', 'c')
                        ->addSelect('c')
                        ->where('m.ref LIKE :ref')
                        ->setParameter('ref', '%'.trim($critere['recherche'], '#!').'%');
                        
                        if(!empty($critere['famille']))
                        {
                                $req->where('c.idFamille IN (:id)') 
                                ->setParameter('id', $critere['famille']);
                        }
                        
                        if(!empty($critere['sousFamille']))
                        {
                                $req->andWhere('c.idSousFamille IN (:id1)') 
                                ->setParameter('id1', $critere['sousFamille']);
                        }
                        
                        if(!empty($critere['stock']))
                        {
                                if($critere['plus_ou_moins'] == 0) 
                                        $req->andWhere('c.stockInterne >= :id2');
                                else
                                        $req->andWhere('c.stockInterne <= :id2');
                                        
                                $req->setParameter('id2', $critere['stock']);
                        }   
                        return $req->getQuery()->getResult();    
                }	
        }
}
