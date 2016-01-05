<?php

namespace IC\AffichageBundle\Repository;

class ApproAutreRepository extends \Doctrine\ORM\EntityRepository
{
	 public function getApproLecteur()
   {
		return $this->createQueryBuilder('al')
		->join('al.appro', 'a')
		->join('al.typeLecteur', 'tl')
		->addSelect('a')
		->addSelect('tl')
		->orderby('al.idCommande')
		->where('a.idLieu = 0 AND a.typeProduit = 3')
		->getQuery()
		->getResult();
   }
}