<?php

namespace IC\AffichageBundle\Repository;

class ApproRepository extends \Doctrine\ORM\EntityRepository
{
   public function getListStAppro()
   {
		return $this->createQueryBuilder('a')
		->join('a.sousTraitant', 's')
		->groupBy('a.idLieu')
		->where('a.idLieu != 0 AND a.typeProduit = 1')
		->getQuery()
		->getResult();
   }
}
