<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ApproComposantRepository extends EntityRepository
{
   public function getApproInterne()
   {
		return $this->createQueryBuilder('ac')
		->join('ac.appro', 'a')
		->join('ac.composant', 'c')
		->addSelect('c')
		->addSelect('a')
		->orderby('ac.idCommande')
		->where('a.idLieu = 0 AND a.typeProduit = 1')
		->getQuery()
		->getResult();
   }
   
   public function getApproSousTraitant($id)
   {
		return $this->createQueryBuilder('ac')
		->join('ac.appro', 'a')
		->join('ac.composant', 'c')
		->addSelect('c')
		->addSelect('a')
		->orderby('ac.idCommande')
		->where('a.idLieu = :id AND a.typeProduit = 1')
		->setParameter('id', $id)
		->getQuery()
		->getResult();	   
   }
}