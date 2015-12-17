<?php

namespace IC\AffichageBundle\Repository;

class LecteurRepository extends \Doctrine\ORM\EntityRepository
{
   public function countLecteur($critere, $id)
   {
        $req = $this->createQueryBuilder('l')
        ->select('COUNT(l.idLecteur) as nbProduit, t.referenceInterne, t.designation')
        ->join('l.typeLecteur', 't')
        ->groupBy('l.idLecteur')
        ->where('t.idFournisseur = :id')
        ->setParameter('id', $id);
        
       if(!empty($critere['recherche']))
        {
            $req->andWhere('t.referenceInterne LIKE :ref')
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
