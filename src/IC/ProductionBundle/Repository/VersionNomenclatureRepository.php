<?php

namespace IC\ProductionBundle\Repository;

/**
 * VersionNomenclature
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VersionNomenclatureRepository extends \Doctrine\ORM\EntityRepository
{
    public function getVersion($id)
    {
        return $this->createQueryBuilder('vn')
        ->where('vn.id = :id')
        ->setParameter('id', $id)
        ->setMaxResults('1')
        ->getQuery()
        ->getResult();
    }   
    
    public function getAllVersion()
    {
        return $this->createQueryBuilder('vn')
        ->join('vn.nomenclature', 'n')
        ->orderBy('vn.idNomenclature', 'ASC')
        ->addOrderBy('vn.version', 'DESC')
        ->getQuery()
        ->getResult();
    }   
}
