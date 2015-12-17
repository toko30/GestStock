<?php

namespace IC\AffichageBundle\Repository;

class ApproIdentifiantRepository extends \Doctrine\ORM\EntityRepository
{
	 public function getApproIdentifiant()
   {
		return $this->createQueryBuilder('ai')
		->join('ai.appro', 'a')
		->join('ai.typeBadge', 'tb')
		->addSelect('a')
		->addSelect('tb')
		->orderby('ai.idCommande')
		->where('a.idLieu = 0 AND a.typeProduit = 2')
		->getQuery()
		->getResult();
   }
}