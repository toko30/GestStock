<?php

namespace IC\AffichageBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LecteurRepository extends EntityRepository
{
   public function countLecteurInterne()
   {
		return $this->createQueryBuilder('l')
		->select('COUNT(l.idLecteur) as nbProduit, t.referenceInterne, t.designation')
		->join('l.typeLecteur', 't')
		->groupBy('l.idLecteur')
		->where('t.idFournisseur = 0')
		->getQuery()
		->getResult();	   
   } 
   
   public function countLecteurCV()
   {
		return $this->createQueryBuilder('l')
		->select('COUNT(l.idLecteur) as nbProduit, t.referenceInterne, t.designation')
		->join('l.typeLecteur', 't')
		->groupBy('l.idLecteur')
		->where('t.idFournisseur = 6')
		->getQuery()
		->getResult();
   }
}
