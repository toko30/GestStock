<?php

namespace IC\AffichageBundle\Repository;

class LecteurRepository extends \Doctrine\ORM\EntityRepository
{
   public function countLecteur($critere)
   {
        $req = $this->createQueryBuilder('l')
        ->select('COUNT(l.idLecteur) as nbProduit, n.nom, t.designation')
        ->join('l.typeLecteur', 't')
        ->join('t.nomenclature', 'n')
        ->groupBy('l.idLecteur');        
        
       if(!empty($critere['recherche']))
        {
            $req->andWhere('n.nom LIKE :ref')
            ->setParameter('ref', '%'.$critere['recherche'].'%');
        }
                
        if(!empty($critere['type']))
        {
            $req->andWhere('t.type IN (:id1)') 
            ->setParameter('id1', $critere['type']);
        }
                
        if(!empty($critere['frequence']))
        {
            $req->andWhere('t.frequence IN (:id2)') 
            ->setParameter('id2', $critere['frequence']);
        }
        
        return $req->getQuery()->getResult();	   
   }
}
