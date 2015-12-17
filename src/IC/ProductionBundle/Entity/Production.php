<?php

namespace IC\ProductionBundle\Entity;

/**
 * Production
 */
class Production
{
    /**
     * @var integer
     */
    private $idLieu;

    /**
     * @var integer
     */
    private $idNomenclature;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var integer
     */
    private $etape;

    /**
     * @var \DateTime
     */
    private $dateProd;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\ProductionBundle\Entity\SousTraitant
     */
    private $sousTraitant;

    /**
     * @var \IC\ProductionBundle\Entity\Nomenclature
     */
    private $nomenclature;


    /**
     * Set idLieu
     *
     * @param integer $idLieu
     *
     * @return Production
     */
    public function setIdLieu($idLieu)
    {
        $this->idLieu = $idLieu;

        return $this;
    }

    /**
     * Get idLieu
     *
     * @return integer
     */
    public function getIdLieu()
    {
        return $this->idLieu;
    }

    /**
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return Production
     */
    public function setIdNomenclature($idNomenclature)
    {
        $this->idNomenclature = $idNomenclature;

        return $this;
    }

    /**
     * Get idNomenclature
     *
     * @return integer
     */
    public function getIdNomenclature()
    {
        return $this->idNomenclature;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Production
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set etape
     *
     * @param integer $etape
     *
     * @return Production
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return integer
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set dateProd
     *
     * @param \DateTime $dateProd
     *
     * @return Production
     */
    public function setDateProd($dateProd)
    {
        $this->dateProd = $dateProd;

        return $this;
    }

    /**
     * Get dateProd
     *
     * @return \DateTime
     */
    public function getDateProd()
    {
        return $this->dateProd;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sousTraitant
     *
     * @param \IC\ProductionBundle\Entity\SousTraitant $sousTraitant
     *
     * @return Production
     */
    public function setSousTraitant(\IC\ProductionBundle\Entity\SousTraitant $sousTraitant = null)
    {
        $this->sousTraitant = $sousTraitant;

        return $this;
    }

    /**
     * Get sousTraitant
     *
     * @return \IC\ProductionBundle\Entity\SousTraitant
     */
    public function getSousTraitant()
    {
        return $this->sousTraitant;
    }

    /**
     * Set nomenclature
     *
     * @param \IC\ProductionBundle\Entity\Nomenclature $nomenclature
     *
     * @return Production
     */
    public function setNomenclature(\IC\ProductionBundle\Entity\Nomenclature $nomenclature = null)
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    /**
     * Get nomenclature
     *
     * @return \IC\ProductionBundle\Entity\Nomenclature
     */
    public function getNomenclature()
    {
        return $this->nomenclature;
    }
}
