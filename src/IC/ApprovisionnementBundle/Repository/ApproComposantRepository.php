<?php

namespace IC\ApprovisionnementBundle\Repository;

/**
 * ApproComposantRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApproComposantRepository extends \Doctrine\ORM\EntityRepository
{
   public function getApproEnCours()
   {
		return $this->createQueryBuilder('ac')
		->select('ac')
		->getQuery()
		->getResult();
   }
   public function getAllApproEnCours()
   {
		return $this->createQueryBuilder('ac')
		->join('ac.appro', 'a')
		->join('ac.composant', 'c')
		->addSelect('c')
		->addSelect('a')
		->orderby('ac.idCommande')
		->where('a.typeProduit = 1')
		->getQuery()
		->getResult();
   }
   
   public function getApproById($id)
   {
		return $this->createQueryBuilder('ac')
		->join('ac.composant', 'c')
		->addSelect('c')
		->orderby('ac.idCommande')
		->where('ac.idCommande = :id')
        ->setParameter('id', $id)
		->getQuery()
		->getResult();
   }
}
