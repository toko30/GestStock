<?php

namespace IC\AffichageBundle\Repository;

class VersionNomenclatureRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllNomenclatureLastVersion()
    {
        return $this->createQueryBuilder('vn')
        ->join('vn.nomenclature', 'n')
        ->addSelect('n')
        ->orderBy('vn.idNomenclature', 'DESC')
        ->addOrderBy('vn.version', 'DESC')
        ->getQuery()->getResult();
    }   
}