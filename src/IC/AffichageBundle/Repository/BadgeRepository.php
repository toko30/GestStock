<?php

namespace IC\AffichageBundle\Repository;

class BadgeRepository extends \Doctrine\ORM\EntityRepository
{
   public function getStockBadge($critere)
   {
        $req = $this->createQueryBuilder('b')
        ->join('b.typeBadge', 'tb')
        ->join('tb.sousTypeBadge', 'stb')
        ->addSelect('tb')
        ->addSelect('stb');
        
        if(!empty($critere['recherche']))
        {
            $req->andWhere('tb.referenceInterne LIKE :ref')
            ->setParameter('ref', '%'.$critere['recherche'].'%');
        }
        if(!empty($critere['type']))
        {
            $req->andWhere('tb.type IN (:id1)') 
            ->setParameter('id1', $critere['type']);
        }
                
        if(!empty($critere['frequence']))
        {
            $req->andWhere('tb.frequence IN (:id2)') 
            ->setParameter('id2', $critere['frequence']);
        }
        
        return $req->getQuery()->getResult();	   
   }
}
