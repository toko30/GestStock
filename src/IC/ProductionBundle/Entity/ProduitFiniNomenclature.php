<?php

namespace IC\ProductionBundle\Entity;

/**
 * ProduitFiniNomenclature
 */
class ProduitFiniNomenclature
{
    /**
     * @var integer
     */
    private $idNomenclature;

    /**
     * @var integer
     */
    private $idComposant;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\ProductionBundle\Entity\VersionNomenclature
     */
    private $version;

    /**
     * @var \IC\ProductionBundle\Entity\Composant
     */
    private $composant;


    /**
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return ProduitFiniNomenclature
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
     * Set idComposant
     *
     * @param integer $idComposant
     *
     * @return ProduitFiniNomenclature
     */
    public function setIdComposant($idComposant)
    {
        $this->idComposant = $idComposant;

        return $this;
    }

    /**
     * Get idComposant
     *
     * @return integer
     */
    public function getIdComposant()
    {
        return $this->idComposant;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ProduitFiniNomenclature
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set version
     *
     * @param \IC\ProductionBundle\Entity\VersionNomenclature $version
     *
     * @return ProduitFiniNomenclature
     */
    public function setVersion(\IC\ProductionBundle\Entity\VersionNomenclature $version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return \IC\ProductionBundle\Entity\VersionNomenclature
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set composant
     *
     * @param \IC\ProductionBundle\Entity\Composant $composant
     *
     * @return ProduitFiniNomenclature
     */
    public function setComposant(\IC\ProductionBundle\Entity\Composant $composant = null)
    {
        $this->composant = $composant;

        return $this;
    }

    /**
     * Get composant
     *
     * @return \IC\ProductionBundle\Entity\Composant
     */
    public function getComposant()
    {
        return $this->composant;
    }
}

