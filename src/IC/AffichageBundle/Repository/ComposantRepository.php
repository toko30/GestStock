<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ComposantRepository extends EntityRepository
{
   public function getStockByCritere($critere)
   {	
        $req = $this->createQueryBuilder('c')
        ->join('c.famille', 'f')
        ->join('c.sousFamille', 's');
        
        if(!empty($critere['recherche']))
        {
                $req->where('c.nom LIKE :nom')
                ->setParameter('nom', '%'.$critere['recherche'].'%');
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
