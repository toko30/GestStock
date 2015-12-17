<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ApproRepository extends EntityRepository
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
