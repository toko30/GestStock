<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LecteurRepository extends EntityRepository
{
   public function countLecteur($critere, $id)
   {
		$req = $this->createQueryBuilder('l')
		->select('COUNT(l.idLecteur) as nbProduit, t.referenceInterne, t.designation')
		->join('l.typeLecteur', 't')
		->groupBy('l.idLecteur')
		->where('t.idFournisseur = :id')
		->setParameter('id', $id);
		
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
