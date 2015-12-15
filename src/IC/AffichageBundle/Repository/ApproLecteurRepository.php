<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ApproLecteurRepository extends EntityRepository
{
	 public function getApproLecteur()
   {
		return $this->createQueryBuilder('al')
		->join('al.appro', 'a')
		->join('al.typeLecteur', 'tl')
		->addSelect('a')
		->addSelect('tl')
		->orderby('al.idCommande')
		->where('a.idLieu = 0 AND a.typeProduit = 3')
		->getQuery()
		->getResult();
   }
}