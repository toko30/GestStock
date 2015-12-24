<?php

namespace IC\AffichageBundle\Repository;

class ProductionRepository extends \Doctrine\ORM\EntityRepository
{
   public function getListStProd()
   {
		return $this->createQueryBuilder('p')
		->join('p.sousTraitant', 's')
		->groupBy('p.idLieu')
		->where('p.idLieu != 0 AND p.etape = 2')
		->getQuery()
		->getResult();
   }
   public function getProdInterne()
   {
		return $this->createQueryBuilder('p')
		->join('p.version', 'v')
        ->join('v.nomenclature', 'n')
		->addSelect('v', 'n')
        ->orderBy('p.dateProd')
		->where('p.idLieu = 0 AND p.etape = 2')
		->getQuery()
		->getResult();
   }
   
   public function getProdSousTraitant($id)
   {
		return $this->createQueryBuilder('p')
		->join('p.version', 'v')
        ->join('v.nomenclature', 'n')
		->join('p.sousTraitant', 's')
		->addSelect('v', 'n', 's')
        ->orderBy('p.dateProd')
		->where('p.idLieu = :id  AND p.etape = 2')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
}
