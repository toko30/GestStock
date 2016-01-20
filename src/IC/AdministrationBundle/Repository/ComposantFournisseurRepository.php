<?php

namespace IC\AdministrationBundle\Repository;

/**
 * ComposantFournisseurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ComposantFournisseurRepository extends \Doctrine\ORM\EntityRepository
{
    public function getListComposantById($idComposant)
    {
       $req = $this->createQueryBuilder('cf')
        ->join('cf.fournisseur', 'f')
        ->join('cf.composant', 'c')
        ->addSelect('c', 'f')
        ->orderBy('cf.idFournisseur', 'ASC')
        ->where('cf.idComposant =:id')
        ->setParameter('id', $idComposant);
        
        /*
        if(!empty($critere['famille']))
        {
                $req->where('c.idFamille IN (:id)') 
                ->setParameter('id', $critere['famille']);
        }
        
        if(!empty($critere['sousFamille']))
        {
                $req->andWhere('c.idSousFamille IN (:id1)') 
                ->setParameter('id1', $critere['sousFamille']);
        }
        */
        return $req->getQuery()->getResult();          
    }
      
}