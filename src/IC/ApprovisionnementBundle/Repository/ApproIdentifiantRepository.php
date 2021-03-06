<?php

namespace IC\ApprovisionnementBundle\Repository;

/**
 * ApproIdentifiantRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ApproIdentifiantRepository extends \Doctrine\ORM\EntityRepository
{
   public function getApproIdentifiant()
   {
		return $this->createQueryBuilder('ai')
		->join('ai.appro', 'a')
        ->join('ai.badge', 'b')
		->join('b.typeBadge', 'tb')
		->addSelect('a', 'b', 'tb')
		->orderby('ai.idCommande')
		->where('a.typeProduit = 2')
		->getQuery()
		->getResult();
   }
   
   public function getApproIdentifiantById($id)
   {
        return $this->createQueryBuilder('ai')
        ->join('ai.badge', 'b')
        ->addSelect('b')
        ->where('ai.idCommande = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
   }
   
}
