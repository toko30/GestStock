<?php

namespace IC\AdministrationBundle\Entity;

/**
 * ComposantNomenclature
 */
class ComposantNomenclature
{
    /**
     * @var integer
     */
    private $idComposant;

    /**
     * @var integer
     */
    private $idNomenclature;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var string
     */
    private $position;

    /**
     * @var integer
     */
    private $optionSt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AdministrationBundle\Entity\Nomenclature
     */
    private $nomenclature;

    /**
     * @var \IC\AdministrationBundle\Entity\Composant
     */
    private $composant;


    /**
     * Set idComposant
     *
     * @param integer $idComposant
     *
     * @return ComposantNomenclature
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
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return ComposantNomenclature
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
     * @return ComposantNomenclature
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
     * Set position
     *
     * @param string $position
     *
     * @return ComposantNomenclature
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set optionSt
     *
     * @param integer $optionSt
     *
     * @return ComposantNomenclature
     */
    public function setOptionSt($optionSt)
    {
        $this->optionSt = $optionSt;

        return $this;
    }

    /**
     * Get optionSt
     *
     * @return integer
     */
    public function getOptionSt()
    {
        return $this->optionSt;
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
     * @param \IC\AdministrationBundle\Entity\Nomenclature $nomenclature
     *
     * @return ComposantNomenclature
     */
    public function setNomenclature(\IC\AdministrationBundle\Entity\Nomenclature $nomenclature = null)
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    /**
     * Get nomenclature
     *
     * @return \IC\AdministrationBundle\Entity\Nomenclature
     */
    public function getNomenclature()
    {
        return $this->nomenclature;
    }

    /**
     * Set composant
     *
     * @param \IC\AdministrationBundle\Entity\Composant $composant
     *
     * @return ComposantNomenclature
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
