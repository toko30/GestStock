<?php

namespace IC\ProductionBundle\Repository;

/**
 * ComposantRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SousTraitantRepository extends \Doctrine\ORM\EntityRepository
{
	public function getComposantSousTraitantById($id)
   {
		return $this->createQueryBuilder('st')
		->join('st.composantSousTraitant', 's')
		->join('s.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
		->where('st.id = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
}
