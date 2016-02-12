<?php

namespace IC\AffichageBundle\Repository;

class ComposantSousTraitantRepository extends \Doctrine\ORM\EntityRepository
{
   public function getStockSousTraitantById($id)
   {
		return $this->createQueryBuilder('s')
		->join('s.sousTraitant', 'st')
		->join('s.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
        ->orderBy('c.nom')
		->where('s.idSousTraitant = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
   
   public function getStockSousTraitantkByCritere($critere, $id)
   {
	   	$req = $this->createQueryBuilder('s')
		->join('s.sousTraitant', 'st')
		->join('s.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
        ->orderBy('c.nom')
		->where('s.idSousTraitant = :id')
		->setParameter('id', $id);
		
        if(!empty($critere['recherche']))
        {
                $req->andWhere('c.nom LIKE :nom')
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
		return $req->getQuery()
		->getResult();	   
   }
}
