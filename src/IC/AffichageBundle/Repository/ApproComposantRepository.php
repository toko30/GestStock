<?php

namespace IC\AffichageBundle\Repository;

class ApproComposantRepository extends \Doctrine\ORM\EntityRepository
{
    public function getApproInterne()
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
}