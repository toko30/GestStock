<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ComposantSousTraitantRepository extends EntityRepository
{
   public function getStockSousTraitantById($id)
   {
		return $this->createQueryBuilder('s')
		->join('s.sousTraitant', 'st')
		->join('s.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
		->where('s.idSousTraitant = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
   
   public function getStockSousTraitantkByCritere($critere, $id)
   {
	   
   }
}
