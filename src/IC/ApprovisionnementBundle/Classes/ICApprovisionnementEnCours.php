<?php

namespace IC\ApprovisionnementBundle\Classes;
use Doctrine\ORM\EntityManager;
use IC\ApprovisionnementBundle\Entity\ComposantSousTraitant;

class ICApprovisionnementEnCours
{
    protected $doctrine;
    
    public function __construct(EntityManager $doctrine)
    {      
        $this->doctrine = $doctrine;
    }
    
    //$doctrine = $this->doctrine;
    
    public function addStockInterne($approComposant)
    {
        $doctrine = $this->doctrine;
        
        foreach($approComposant as $aComp)
        {
            $newQuantite = $aComp->getComposant()->setStockInterne($aComp->getComposant()->getStockInterne() + $aComp->getQuantite());
            
            $doctrine->persist($newQuantite);
            $doctrine->remove($aComp);
        }
        
        $doctrine->flush();
    }
    
    public function addStockSousTraitant($request, $idSousTraitant)
    {
        $doctrine = $this->doctrine;
        
        foreach ($request->get('option') as $idComposant) 
        {
            $composantST = $doctrine->getRepository('ICApprovisionnementBundle:ComposantSousTraitant')->getComposantBySousTraitant($idComposant, $idSousTraitant);
            $composant = $doctrine->getRepository('ICApprovisionnementBundle:Composant')->findOneBy(array('id' => $idComposant));
            $sousTraitant = $doctrine->getRepository('ICApprovisionnementBundle:SousTraitant')->findOneBy(array('id' => $idSousTraitant));

            if(!empty($composantST))
            {
                $composantST[0]->setQuantite($composantST[0]->getQuantite() + $request->get($idComposant));
                
                $doctrine->persist($composantST[0]);
            }
            else
            {               
                $newComposantST = new ComposantSousTraitant();
                $newComposantST->setSousTraitant($sousTraitant);
                $newComposantST->setComposant($composant);
                $newComposantST->setQuantite($request->get($idComposant));
                
                $doctrine->persist($newComposantST);
            }
            
            $composant->setStockInterne($composant->getStockinterne() - $request->get($idComposant));
            $doctrine->persist($composant);
        }
        
        $doctrine->flush();
    }
}
