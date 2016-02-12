<?php

namespace IC\AffichageBundle\Repository;

class ApproLecteurRepository extends \Doctrine\ORM\EntityRepository
{
    public function getApproLecteur()
    {
        return $this->createQueryBuilder('al')
        ->join('al.appro', 'a')
        ->join('al.typeLecteurAutre', 'tla')
        ->addSelect('a', 'tla')
        ->orderby('al.idCommande')
        ->where('a.typeProduit = 3')
        ->getQuery()
        ->getResult();
    }
}
