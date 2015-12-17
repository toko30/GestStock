<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ComposantNomenclatureRepository extends EntityRepository
{
   public function getComposantNomenclatureCompleteById($id)
   {
		return $this->createQueryBuilder('nc')
		->join('nc.nomenclature', 'n')
		->join('nc.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
		->addSelect('c')
		->where('nc.idNomenclature = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
   
   public function getComposantNomenclaturePCBById($id)
   {
		return $this->createQueryBuilder('n')
		->join('n.composant', 'c')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
		->addSelect('c')
		->where('n.idNomenclature = :id AND c.idFamille = 1')
		->setParameter('id', $id)
		->getQuery()
		->getResult();	   
   }
}
