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
        
        if(!empty($critere['formComposantInterne']['famille']))
        {
                $req->where('c.idFamille IN (:id)') 
                ->setParameter('id', $critere['formComposantInterne']['famille']);
        }
        
        if(!empty($critere['formComposantInterne']['sousFamille']))
        {
                $req->andWhere('c.sousFamille IN (:id1)') 
                ->setParameter('id1', $critere['formComposantInterne']['sousFamille']);
        }
        if(isset($critere['formComposantInterne']['etat']) && $critere['formComposantInterne']['etat'] == 1)
        {
                $req->andWhere('c.stockMini < c.stock');
        }
        return $req->getQuery()->getResult();
   }
}
