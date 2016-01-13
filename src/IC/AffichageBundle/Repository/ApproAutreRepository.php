<?php

namespace IC\AffichageBundle\Repository;

class ApproAutreRepository extends \Doctrine\ORM\EntityRepository
{
    public function getApproAutre()
    {
        return $this->createQueryBuilder('al')
        ->join('al.appro', 'a')
        ->join('al.autre', 'ta')
        ->addSelect('a')
        ->addSelect('ta')
        ->orderby('al.idCommande')
        ->where('a.typeProduit = 4')
        ->getQuery()
        ->getResult();
    }
}