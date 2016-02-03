<?php

namespace IC\AdministrationBundle\Entity;

/**
 * ProduitFiniNomenclature
 */
class ProduitFiniNomenclature
{
    /**
     * @var integer
     */
    private $idVersion;

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
     * @var \IC\AdministrationBundle\Entity\VersionNomenclature
     */
    private $version;

    /**
     * @var \IC\AdministrationBundle\Entity\Composant
     */
    private $composant;


    /**
     * Set idVersion
     *
     * @param integer $idVersion
     *
     * @return ProduitFiniNomenclature
     */
    public function setIdVersion($idVersion)
    {
        $this->idVersion = $idVersion;

        return $this;
    }

    /**
     * Get idVersion
     *
     * @return integer
     */
    public function getIdVersion()
    {
        return $this->idVersion;
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
     * @param \IC\AdministrationBundle\Entity\VersionNomenclature $version
     *
     * @return ProduitFiniNomenclature
     */
    public function setVersion(\IC\AdministrationBundle\Entity\VersionNomenclature $version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return \IC\AdministrationBundle\Entity\VersionNomenclature
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set composant
     *
     * @param \IC\AdministrationBundle\Entity\Composant $composant
     *
     * @return ProduitFiniNomenclature
     */
    public function setComposant(\IC\AdministrationBundle\Entity\Composant $composant = null)
    {
        $this->composant = $composant;

        return $this;
    }

    /**
     * Get composant
     *
     * @return \IC\AdministrationBundle\Entity\Composant
     */
    public function getComposant()
    {
        return $this->composant;
    }
}
