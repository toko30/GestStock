<?php

namespace IC\AffichageBundle\Repository;

class SousTraitantRepository extends \Doctrine\ORM\EntityRepository
{
	public function getComposantSousTraitantById($id)
   {
		return $this->createQueryBuilder('st')
		->join('st.composantSousTraitant', 's')
		->join('s.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
        ->orderBy('c.designation')
		->where('st.id = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
}
