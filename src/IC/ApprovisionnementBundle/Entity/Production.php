<?php

namespace IC\ApprovisionnementBundle\Entity;

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
     * @var string
     */
    private $composantUtilise;

    /**
     * @var \DateTime
     */
    private $dateProd;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\SousTraitant
     */
    private $sousTraitant;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\VersionNomenclature
     */
    private $version;


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
     * Set composantUtilise
     *
     * @param string $composantUtilise
     *
     * @return Production
     */
    public function setComposantUtilise($composantUtilise)
    {
        $this->composantUtilise = $composantUtilise;

        return $this;
    }

    /**
     * Get composantUtilise
     *
     * @return string
     */
    public function getComposantUtilise()
    {
        return $this->composantUtilise;
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
     * @param \IC\ApprovisionnementBundle\Entity\SousTraitant $sousTraitant
     *
     * @return Production
     */
    public function setSousTraitant(\IC\ApprovisionnementBundle\Entity\SousTraitant $sousTraitant = null)
    {
        $this->sousTraitant = $sousTraitant;

        return $this;
    }

    /**
     * Get sousTraitant
     *
     * @return \IC\ApprovisionnementBundle\Entity\SousTraitant
     */
    public function getSousTraitant()
    {
        return $this->sousTraitant;
    }

    /**
     * Set version
     *
     * @param \IC\ApprovisionnementBundle\Entity\VersionNomenclature $version
     *
     * @return Production
     */
    public function setVersion(\IC\ApprovisionnementBundle\Entity\VersionNomenclature $version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return \IC\ApprovisionnementBundle\Entity\VersionNomenclature
     */
    public function getVersion()
    {
        return $this->version;
    }
}

