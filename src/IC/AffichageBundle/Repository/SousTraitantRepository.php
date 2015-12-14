<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SousTraitantRepository extends EntityRepository
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
