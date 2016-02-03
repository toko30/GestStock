<?php

namespace IC\AffichageBundle\Repository;

class ApproLecteurRepository extends \Doctrine\ORM\EntityRepository
{
    public function getApproLecteur()
    {
        return $this->createQueryBuilder('al')
        ->join('al.appro', 'a')
        ->join('al.typeLecteur', 'tl')
        ->addSelect('a')
        ->addSelect('tl')
        ->orderby('al.idCommande')
        ->where('a.typeProduit = 3')
        ->getQuery()
        ->getResult();
    }
}
