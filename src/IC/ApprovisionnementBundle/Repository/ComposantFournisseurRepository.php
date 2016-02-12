<?php

namespace IC\ApprovisionnementBundle\Repository;

/**
 * ComposantFournisseurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ComposantFournisseurRepository extends \Doctrine\ORM\EntityRepository
{
    public function GetComposantFournisseurById($listeIdComposant)
    {
        for($i = 0; $i < count($listeIdComposant); $i++)
        {
            $listeId[] = $listeIdComposant[$i]['idComposant'];
        }
        
        $req = $this->createQueryBuilder('cf')
        ->join('cf.fournisseur', 'f')
        ->join('cf.composant', 'c')
        ->orderBy('c.designation')
        ->addSelect('c', 'f')
        ->orderBy('cf.idFournisseur', 'ASC')
        ->where('cf.idComposant IN (:id)')
        ->setParameter('id', $listeId);
        
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
