<?php

namespace IC\AdministrationBundle\Repository;

/**
 * TypeBadgeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TypeBadgeRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllTypeIdentifiant()
    {
        return $this->createQueryBuilder('tb')
        ->join('tb.fournisseur', 'f')
        ->join('tb.sousTypeBadge', 'stb')
        ->addSelect('f', 'stb')
        ->getQuery()->getResult();
    }
}
