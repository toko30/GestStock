<?php

namespace IC\AdministrationBundle\Repository;

/**
 * VersionNomenclature
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VersionNomenclatureRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLastVersionNomenclature($order)
    {
        $req = $this->createQueryBuilder('vn')
        ->join('vn.nomenclature', 'n')
        ->addSelect('n')
        ->orderBy('vn.idNomenclature', 'DESC');
        
        if($order == 0)
            $req->addOrderBy('vn.version', 'DESC');
        else
            $req->addOrderBy('vn.version', 'ASC');
            
         return $req->getQuery()->getResult();
    }
    
    public function getLastVersionByNomenclature($idNomenclature)
    {
        return $this->createQueryBuilder('vn')
        ->addOrderBy('vn.version', 'DESC')
        ->where('vn.idNomenclature = :idNomenclature')
        ->setParameter('idNomenclature', $idNomenclature)
        ->getQuery()->getResult();
    }
}
