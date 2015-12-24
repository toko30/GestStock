<?php

namespace IC\AffichageBundle\Repository;

class ComposantNomenclatureRepository extends \Doctrine\ORM\EntityRepository
{
   public function getComposantNomenclatureCompleteById($id)
   {
		return $this->createQueryBuilder('nc')
        ->join('nc.composant', 'c')
		->join('nc.version', 'v')
        ->join('v.nomenclature', 'n')
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
		return $this->createQueryBuilder('nc')
        ->join('nc.composant', 'c')
		->join('nc.version', 'v')
        ->join('v.nomenclature', 'n')
		->join('c.famille', 'f')
		->join('c.sousFamille', 'sf')
		->addSelect('c', 'v', 'n')
		->where('nc.idNomenclature = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();   
   }
}
