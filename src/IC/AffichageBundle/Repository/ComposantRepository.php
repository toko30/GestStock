<?php

namespace IC\AffichageBundle\Repository;

class ComposantRepository extends \Doctrine\ORM\EntityRepository
{
   public function getStockByCritere($critere)
   {	
        $req = $this->createQueryBuilder('c')
        ->join('c.famille', 'f')
        ->join('c.sousFamille', 's')
        ->orderBy('c.nom');
        if(!empty($critere['recherche']))
        {
                $req->where('c.nom LIKE :nom')
                ->setParameter('nom', '%'.trim($critere['recherche'], '#!').'%');
        }   
             
        if(!empty($critere['famille']))
        {
                $req->andWhere('c.idFamille IN (:id)') 
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
