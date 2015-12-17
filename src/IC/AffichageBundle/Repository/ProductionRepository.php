<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductionRepository extends EntityRepository
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
		->join('p.nomenclature', 'n')
		->addSelect('n')
		->where('p.idLieu = 0')
		->getQuery()
		->getResult();
   }
   
   public function getProdSousTraitant($id)
   {
		return $this->createQueryBuilder('p')
		->join('p.nomenclature', 'n')
		->join('p.sousTraitant', 's')
		->addSelect('n')
		->addSelect('s')
		->where('p.idLieu = :id')
		->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
}
