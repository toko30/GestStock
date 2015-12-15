<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BadgeRepository extends EntityRepository
{
   public function getStockBadge()
   {
        return $this->createQueryBuilder('b')
        ->join('b.typeBadge', 'tb')
        ->join('tb.sousTypeBadge', 'stb')
        ->addSelect('tb')
        ->addSelect('stb')
        ->getQuery()
        ->getResult();	   
   }
}
