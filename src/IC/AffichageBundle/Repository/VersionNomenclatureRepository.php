<?php

namespace IC\AffichageBundle\Repository;

class VersionNomenclatureRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllNomenclatureLastVersion()
    {
        return $this->createQueryBuilder('v')
        ->join('v.nomenclature', 'n')
        ->orderBy('v.version', 'DESC')
        ->getQuery()
        ->getResult();
    }   
}