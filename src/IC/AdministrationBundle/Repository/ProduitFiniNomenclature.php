<?php

namespace IC\AdministrationBundle\Repository;

/**
 * ProduitFiniNomenclature
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitFiniNomenclature extends \Doctrine\ORM\EntityRepository
{
    public function getComposantByNomenclature($idNomenclature)
    {
        return $this->createQueryBuilder('pfn')
        ->where('pfn.idVersion = :idVersion')
        ->setParameter('idVersion', $idNomenclature)
        ->getQuery()
        ->getResult();
    }
}
