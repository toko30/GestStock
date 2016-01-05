<?php

namespace IC\ApprovisionnementBundle\Repository;

/**
 * ComposantNomenclatureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ComposantNomenclatureRepository extends \Doctrine\ORM\EntityRepository
{
    public function getComposantNomenclature($id)
	{
		return $this->createQueryBuilder('nc')
		->join('nc.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
		->addSelect('nc', 'c')
		->where('nc.idNomenclature = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
	}
}
