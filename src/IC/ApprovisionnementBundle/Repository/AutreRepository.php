<?php

namespace IC\ApprovisionnementBundle\Repository;

/**
 * AutreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AutreRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllAutre()
    {
        return $this->createQueryBuilder('a')
        ->join('a.typeAutre', 'ta')
        ->join('a.fournisseur', 'f')
        ->addSelect('ta', 'f')
        ->orderBy('a.idFournisseur')
        ->getQuery()
        ->getResult();
    }
}
