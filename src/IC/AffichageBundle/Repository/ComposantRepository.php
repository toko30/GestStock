<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ComposantRepository extends EntityRepository
{
   public function getStockByCritere($critere)
   {	   
        return $this->createQueryBuilder('c')
        ->join('c.famille', 'f')
        ->join('c.sousFamille', 's')
        ->getQuery()
        ->getResult();
   }
}
