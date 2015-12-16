<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MoqRepository extends EntityRepository
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
                                ->where('m.idFournisseur = :id') 
                                ->setParameter('id', $fournisseur);
                                if(!empty($critere['recherche']))
                                {
                                        $req->andWhere('m.ref LIKE :ref')
                                        ->setParameter('ref', '%'.$critere['recherche'].'%');
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
                                        $req->andWhere('c.sousFamille IN (:id1)') 
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
                        ->setParameter('ref', '%'.$critere['recherche'].'%');
                        
                        if(!empty($critere['famille']))
                        {
                                $req->where('c.idFamille IN (:id)') 
                                ->setParameter('id', $critere['famille']);
                        }
                        
                        if(!empty($critere['sousFamille']))
                        {
                                $req->andWhere('c.sousFamille IN (:id1)') 
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
