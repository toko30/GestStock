<?php

namespace IC\AffichageBundle\Repository;

class ApproRepository extends \Doctrine\ORM\EntityRepository
{
   public function getListStAppro()
   {
		return $this->createQueryBuilder('a')
		->where('a.typeProduit = 1')
		->getQuery()
		->getResult();
   }
}
