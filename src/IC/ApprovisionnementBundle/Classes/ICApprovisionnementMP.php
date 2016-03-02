<?php

namespace IC\ApprovisionnementBundle\Classes;
use Doctrine\ORM\EntityManager;
use IC\ApprovisionnementBundle\Entity\Appro;
use IC\ApprovisionnementBundle\Entity\ApproComposant;

class ICApprovisionnementMP
{
    protected $doctrine;
    
    public function __construct(EntityManager $doctrine)
    {      
        $this->doctrine = $doctrine;
    }
    
    public function calculApproProd()
    {
        $doctrine = $this->doctrine;
        
        $listProduction = $doctrine->getRepository('ICApprovisionnementBundle:Production')->getListProdEnAttente();
        $quantiteCommande = array();
        $composantStockST = array();
        
        foreach($listProduction as $production)
        {
            $listComposantNomenclature = $doctrine->getRepository('ICApprovisionnementBundle:ComposantNomenclature')->getComposantNomenclature($production->getIdNomenclature());
            $listComposantSousTraitant = $doctrine->getRepository('ICApprovisionnementBundle:ComposantSousTraitant')->getComposantSt($production->getIdLieu());
            $listComposantUtilise = explode(',', $production->getComposantUtilise());
            
            foreach($listComposantNomenclature as $composantNomenclature)
            {
                //si le composant fais parti des composants à envoyé au sous traitant ou si la production se fais en interne
                if(in_array($composantNomenclature->getIdComposant(), $listComposantUtilise) || $production->getIdLieu() == 0)
                {
                    //au premier tour de boucle on créé le premier champ du tableau
                    if(!isset($quantiteCommande[0]['idComposant']))
                    {
                        $quantiteCommande[0]['idComposant'] = $composantNomenclature->getIdComposant();
                        $quantiteCommande[0]['quantite'] = $composantNomenclature->getComposant()->getStockInterne() - ($composantNomenclature->getQuantite() * $production->getQuantite());
                    }
                    else
                    {
                        $existe = 0;
                        //vérification si le composant a déja été renseigner pour une autre nomenclature
                        for($i = 0; $i < count($quantiteCommande); $i++)
                        {
                            //si il l'a été on ajoute simplement la quantité à celle existante
                            if($quantiteCommande[$i]['idComposant'] == $composantNomenclature->getIdComposant())
                            {
                                $existe = 1;
                                $quantiteCommande[$i]['quantite'] -= $composantNomenclature->getQuantite() * $production->getQuantite();
                            }
                        }
                        
                        //si il n'existe pas on le créé
                        if($existe == 0)
                        {
                            $next = count($quantiteCommande);
                            $quantiteCommande[$next]['idComposant'] = $composantNomenclature->getIdComposant();
                            $quantiteCommande[$next]['quantite'] = $composantNomenclature->getComposant()->getStockInterne() - ($composantNomenclature->getQuantite() * $production->getQuantite());                            
                        }
                    }
                }
                
                $composantStockST = array();
                //ajout de la quantité du stock sous traitant à additionner au stock à commander
                if(in_array($composantNomenclature->getIdComposant(), $listComposantUtilise))
                {
                    foreach($listComposantSousTraitant as $composantSousTraitant)
                    {
                        //on vérifie que le composant existe en stock chez le sous traitant
                        if($composantSousTraitant->getIdComposant() == $composantNomenclature->getIdComposant())
                        {
                            //au premier tour de boucle on créé le premier champ du tableau
                            if(!isset($composantStockST[0]['idComposant']))
                            {
                                $composantStockST['lieu'] = $production->getIdLieu();
                                $composantStockST['idComposant'][] = $composantSousTraitant->getIdComposant();
                                $composantStockST['quantite'][] = $composantSousTraitant->getQuantite();
                            }
                            else
                            {
                                $existe = 0;
                                
                                for($i = 0; $i < count($composantStockST['idComposant']); $i++)
                                {
                                    //on vérifie que le composant n'existe pas déja chez un autre sous traitant sinon on l'ajoute a celui ci 
                                    //on vérifie que l'on ne fais pas de doublon en comparant que le sous traitant actuel est différent du sous traitant enregistré
                                    if($composantStockST['idComposant'][$i] == $composantNomenclature->getIdComposant() && $composantStockST['lieu'][$i] != $production->getIdLieu())
                                    {
                                        $existe = 1;
                                        $composantStockST['lieu'][] = $production->getIdLieu();
                                        $composantStockST['quantite'][$i] += $composantSousTraitant->getQuantite();
                                    }
                                }
                                //si il n'existe pas on le créé
                                if($existe == 0)
                                {
                                    $composantStockST['lieu'][] = $production->getIdLieu();
                                    $composantStockST['idComposant'][] = $composantSousTraitant->getIdComposant();
                                    $composantStockST['quantite'][] = $composantSousTraitant->getQuantite();
                                }
                            }
                        }
                    }
                }
            }
        }
        return array($quantiteCommande, $composantStockST);
    }
    
    public function calculApproCritique()
    {
        $doctrine = $this->doctrine;
        
        $listComposant = $doctrine->getRepository('ICApprovisionnementBundle:Composant')->findAll();
        
        $i = 0;
        foreach ($listComposant as $composant) {
            if($composant->getStockInterne() < $composant->getStockMini())
            {
                $quantiteCommande[$i]['idComposant'] = $composant->getId();
                $quantiteCommande[$i++]['quantite'] = $composant->getStockInterne() - $composant->getStockMini();
            }
        }
        if(!isset($quantiteCommande))
            $quantiteCommande = array();
            
        return $quantiteCommande;        
    }
    
    public function ajoutStockST($composantStockST, $quantiteCommande)
    {
        for($i = 0; $i < count($composantStockST['idComposant']); $i++)
        {
            for($i1 = 0; $i1 < count($quantiteCommande); $i1++) 
            {
                if($quantiteCommande[$i1]['idComposant'] == $composantStockST['idComposant'][$i])
                {
                    $quantiteCommande[$i1]['quantite'] += $composantStockST['quantite'][$i]; 
                }
            }
        }
        return $quantiteCommande;
    }
    
    //Ajout au stock les composant qui sont en cours d'approvisionnement
    public function ajoutApproEnCour($composantApproEncours, $quantiteCommande)
    {
        foreach($composantApproEncours as $appro)
        {
            for($i = 0; $i < count($quantiteCommande); $i++) 
            {
                if($quantiteCommande[$i]['idComposant'] == $appro->getIdProduit())
                {
                    $quantiteCommande[$i]['quantite'] += $appro->getQuantite(); 
                }
            }
        }    
        return $quantiteCommande;    
    }
    
    //On trie en supprimmant les composants dont le stock est suffisant
    public function verifStockCommande($quantiteCommande)
    {
        $nbQuantiteCommande = count($quantiteCommande);
        
        for($i = 0; $i < $nbQuantiteCommande; $i++)
        {
            if($quantiteCommande[$i]['quantite'] > 0)
                unset($quantiteCommande[$i]);
            else
                $quantiteCommande[$i]['quantite'] = abs($quantiteCommande[$i]['quantite']);
        }

        return array_values($quantiteCommande);        
    }
    
    public function addAproComposant($request, $idFournisseur)
    {
        $doctrine = $this->doctrine;
        $existe = 0;

        $fournisseur = $doctrine->getRepository('ICApprovisionnementBundle:Fournisseur')->findOneBy(array('id' => $idFournisseur));

        $appro = new Appro();
        $appro->setFournisseur($fournisseur);
        $appro->setTypeProduit(1);
        $appro->setDateCommande(new \Datetime());
        
        $doctrine->persist($appro);
        $doctrine->flush();  
            
        $lastAppro = $doctrine->getRepository('ICApprovisionnementBundle:Appro')->getLastAppro();
            
        foreach ($request->get('listId') as $id)
        {
			$vide = $request->get($id);
            
            if(!empty($vide))
            {
                $existe = 1; 
                $composant = $doctrine->getRepository('ICApprovisionnementBundle:Composant')->findOneBy(array('id' => $id));
                
                $composantAppro = new ApproComposant();
                $composantAppro->setComposant($composant);
                $composantAppro->setQuantite($request->get($id));
                $composantAppro->setAppro($lastAppro[0]);
                
                $doctrine->persist($composantAppro);
            }
        }
        
        if($existe == 0)
        {
            $doctrine->remove($lastAppro[0]);
        }
        
        $doctrine->flush();
                    
    }
}