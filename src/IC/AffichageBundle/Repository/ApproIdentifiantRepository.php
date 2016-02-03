<?php

namespace IC\AffichageBundle\Repository;

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
}