<?php
namespace IC\AffichageBundle\Form;

class MenuComposantInterne
{
    private $recherche;
    private $typeRecherche = 0;
    private $famille;
    private $sousFamille;
    private $etat;
    private $fournisseur;
    private $nomenclature;
    private $quantite;
    private $supOuInf;
    
    public function __construct()
    {
        
    }
    
    public function setRecherche($recherche)
    {
        $this->recherche = $recherche;

        return $this;
    }

    public function getRecherche()
    {
        return $this->recherche;
    }
    
    public function setTypeRecherche($typeRecherche)
    {
        $this->typeRecherche = $typeRecherche;

        return $this;
    }

    public function getTypeRecherche()
    {
        return $this->typeRecherche;
    }
    
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    public function getFamille()
    {
        return $this->famille;
    }
    
    public function setSousFamille($sousFamille)
    {
        $this->sousFamille = $sousFamille;

        return $this;
    }

    public function getSousFamille()
    {
        return $this->sousFamille;
    }
    
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    public function getEtat()
    {
        return $this->etat;
    }
        
    public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getFournisseur()
    {
        return $this->fournisseur;
    }
    
    public function setNomenclature($nomenclature)
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    public function getNomenclature()
    {
        return $this->nomenclature;
    }
    
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }
    
    public function setSupOuInf($supOuInf)
    {
        $this->supOuInf = $supOuInf;

        return $this;
    }

    public function getSupOuInf()
    {
        return $this->supOuInf;
    }
}
