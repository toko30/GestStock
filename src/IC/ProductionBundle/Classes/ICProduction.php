<?php

namespace IC\ProductionBundle\Classes;
use Doctrine\ORM\EntityManager;


class ICProduction
{
    protected $doctrine;
    
    public function __construct(EntityManager $doctrine)
    {      
        $this->doctrine = $doctrine;
    }
    
    //$doctrine = $this->doctrine;
    
    //Listage des dernières nomenclatures
    public function listLastNomenclature()
    {
        $doctrine = $this->doctrine;
        
        $listeAllVersionNomenclature = $doctrine->getRepository('ICProductionBundle:VersionNomenclature')->getAllVersion();
        $i = 0;
        foreach($listeAllVersionNomenclature as $versionNomenclature)
        {
            if($i != $versionNomenclature->getNomenclature()->getId())
            {
                $i = $versionNomenclature->getNomenclature()->getId();
                $listLastNomenclature[] = $versionNomenclature;
            }
        }
        return $listLastNomenclature;
    }
    
    public function calculQteproduction($nbProdManquant, $calculStockRestant,Composant $composant)
    {
        if($calculStockRestant < 0)
        {
            $calculQuantite = round(abs($calculStockRestant) / $composant->getQuantite(), 0, PHP_ROUND_HALF_DOWN);
            
            if(isset($nbProdManquant))
            {
                if($nbProdManquant < $calculQuantite)
                    $nbProdManquant = $calculQuantite;
            }
            else
                $nbProdManquant = $calculQuantite;
        }
        return $nbProdManquant;
    }
    
    public function getListComposantNomenclatureInterne($data, $idVersion)
    {
        $doctrine = $this->doctrine;
        
        //recupération du nom de la nomenclature et les composants qui y sont liés
        $listeComposantnomenclature = $doctrine->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($idVersion);
        
        //déclaration à 0 du nombre de carte qui ne pourront pas être produites
        $tabComposant = array();
        $nbProdManquant = 0;
        $i = 0;
        $nomenclature = '';
        if(!empty($listeComposantnomenclature))
        {
            $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();
            
            //Calcul des cartes pouvant etre produites
            foreach($listeComposantnomenclature as $composant)
            {
                $calculStockRestant = $composant->getComposant()->getStockInterne() - ($composant->getQuantite() * $data['quantite']);

                $tabComposant[$i]['designation'] = $composant->getComposant()->getNom();
                $tabComposant[$i]['quantite'] = $composant->getQuantite() * $data['quantite'];             
                $tabComposant[$i++]['stock'] = $calculStockRestant;
                
                //Mise a jour du nombre de carte qui ne pourront pas etre produite avec le stock actuel
                $nbProdManquant = self::calculQteproduction($nbProdManquant, $calculStockRestant, $composant);
            }
        }
        return array($tabComposant, $nbProdManquant, $nomenclature);
    }
    
    public function getTabProdInterne()
    {
        $doctrine = $this->doctrine;
        
        //récupération des productions Internes
        $listeProd = $doctrine->getRepository('ICProductionBundle:Production')->getProdInterne(0);
        
        //déclaration des variable vide au cas ou il n'y est pas de prod de lancée
        $listeEnCours = '';
        $listePrevisionnelle = '';
        
        $i = 0;
        $i1 = 0;
        
        foreach($listeProd as $prod)
        {
            //enregistrement des productions en cours pour affichage
            if($prod->getEtape() == 2)
            {
                $listeEnCours[$i]['id'] = $prod->getId();
                $listeEnCours[$i]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                $listeEnCours[$i]['quantite'] = $prod->getQuantite();
                $listeEnCours[$i++]['date_prod'] = $prod->getDateProd();
            }
            else
            {
                //enregistrement des prod prévisionelle pour affichage                                      
                $listePrevisionnelle[$i1]['id'] = $prod->getId();
                $listePrevisionnelle[$i1]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                $listePrevisionnelle[$i1]['quantite'] = $prod->getQuantite();
                $listePrevisionnelle[$i1]['lancement'] = 1;
                
                //vérification de la possibilitée de lancement d'une production
                $listeComposantnomenclature = $doctrine->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($prod->getVersion()->getId());
                
                foreach($listeComposantnomenclature as $composantNomenclature)
                {
                    if($composantNomenclature->getComposant()->getStockInterne() - ($prod->getQuantite() * $composantNomenclature->getQuantite()) < 0)
                    {
                        $listePrevisionnelle[$i1]['lancement'] = 0; 
                        break;
                    }
                }
                $i1++;
            }
        }
        return array($listeEnCours, $listePrevisionnelle);
    }
    public function getListComposantNomenclatureSousTraitant($data, $idVersion, $id)
    {
        $doctrine = $this->doctrine;
        
        //enregistrement du sous traitant, du nom de la nomenclature et les composants qui y sont liés
        $ComposantSousTraitant = $doctrine->getRepository('ICProductionBundle:ComposantSousTraitant')->getComposantSt($id);
        $listeComposantnomenclature = $doctrine->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($idVersion);  
            
        //déclaration à 0 du nombre de carte qui ne pourront pas être produites    
        $tabComposant = array();
        $nbProdManquant = 0;
        $i = 0;
        $nomenclature = '';   
            
        if(!empty($listeComposantnomenclature))
        {
            $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();                           

            //Calcul des cartes pouvant etre produites          
            foreach ($listeComposantnomenclature as $composant)
            {
                $calculStockRestant = 0 - ($composant->getQuantite() * $data['quantite']);
                
                //Vérification de la présence des composant dans le stock sous Traitant
                foreach($ComposantSousTraitant as $st)
                {
                    if($st->getIdComposant() == $composant->getComposant()->getId())
                        $calculStockRestant = $st->getQuantite() - ($composant->getQuantite() * $data['quantite']);
                }
                    
                $tabComposant[$i]['id'] = $composant->getComposant()->getId();
                $tabComposant[$i]['designation'] = $composant->getComposant()->getNom();
                $tabComposant[$i]['quantite'] = $composant->getQuantite() * $data['quantite'];           
                $tabComposant[$i]['stock'] = $calculStockRestant;
                $tabComposant[$i++]['option'] = $composant->getOptionSt();
                
                //Mise a jour du nombre de carte qui ne pourront pas etre produite avec le stock actuel
                $nbProdManquant = self::calculQteproduction($nbProdManquant, $calculStockRestant, $composant);
            }
        }
        return array($tabComposant, $nbProdManquant, $nomenclature);        
    }
    
    public function getTabProdSousTraitant($id)
    {
        $doctrine = $this->doctrine;
        
        $listeProd = $doctrine->getRepository('ICProductionBundle:Production')->getProdInterne($id);
        
        //déclaration des variable vide au cas ou il n'y est pas de prod de lancée
        
        $listeEnCours = '';
        $listePrevisionnelle = '';
        
        $i = 0;
        $i1 = 0;
        
        foreach($listeProd as $prod)
        {
            //enregistrement des productions en cours
            if($prod->getEtape() == 2)
            {
                $listeEnCours[$i]['id'] = $prod->getId();
                $listeEnCours[$i]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                $listeEnCours[$i]['quantite'] = $prod->getQuantite();
                $listeEnCours[$i++]['date_prod'] = $prod->getDateProd();
            }
            else
            {
                //récupération des composant utiliser pour la prod St
                $listeComposantUtiliseSt = explode(',', $prod->getComposantUtilise());
                
                //enregistrement des prod prévisionelle
                $listeComposantnomenclature = $doctrine->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($prod->getVersion()->getId());
                $listeComposantSousTraitant = $doctrine->getRepository('ICProductionBundle:ComposantSousTraitant')->getComposantSt($id);
                
                $listePrevisionnelle[$i1]['id'] = $prod->getId();
                $listePrevisionnelle[$i1]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                $listePrevisionnelle[$i1]['quantite'] = $prod->getQuantite();
                $listePrevisionnelle[$i1]['lancement'] = 1;        
                
                //vérification de la possibilité de lancement d'une production
                foreach($listeComposantnomenclature as $composantNomenclature)
                {
                    if(in_array($composantNomenclature->getComposant()->getId(), $listeComposantUtiliseSt))
                    {
                        if(empty($listeComposantSousTraitant))
                        {
                            $composantManquant = 1;
                        }
                        else
                        {
                            foreach($listeComposantSousTraitant as $composantSt)
                            {
                                $composantManquant = 1;
                                
                                if($composantNomenclature->getComposant()->getId() == $composantSt->getIdComposant())
                                {                          
                                    $composantManquant = 0;
                                    if($composantSt->getQuantite() - ($prod->getQuantite() * $composantNomenclature->getQuantite()) < 0)
                                    {
                                        $listePrevisionnelle[$i1]['lancement'] = 0; 
                                        break;
                                    }
                                    break; 
                                }
                            }                                
                        }

                        //Si le composant n'est pas trouvé dans la boucle c'est qu'il n'est pas chez le sousTraitant(on ne peut donc pas produire)
                        if($composantManquant == 1)
                        {
                            $listePrevisionnelle[$i1]['lancement'] = 0; 
                            break;
                        }
                    }
                }
                $i1++;
            }
        }
        return array($listeEnCours, $listePrevisionnelle);
    }
}
