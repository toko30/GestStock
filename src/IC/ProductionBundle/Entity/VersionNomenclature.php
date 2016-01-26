<?php

namespace IC\ProductionBundle\Entity;

/**
 * VersionNomenclature
 */
class VersionNomenclature
{
    /**
     * @var integer
     */
    private $idNomenclature;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\ProductionBundle\Entity\Nomenclature
     */
    private $nomenclature;


    /**
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return VersionNomenclature
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
     * Set version
     *
     * @param integer $version
     *
     * @return VersionNomenclature
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
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
     * Set nomenclature
     *
     * @param \IC\ProductionBundle\Entity\Nomenclature $nomenclature
     *
     * @return VersionNomenclature
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

