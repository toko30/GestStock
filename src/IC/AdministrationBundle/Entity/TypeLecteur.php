<?php

namespace IC\AdministrationBundle\Entity;

/**
 * TypeLecteur
 */
class TypeLecteur
{
    /**
     * @var integer
     */
    private $idNomenclature;

    /**
     * @var string
     */
    private $designation;

    /**
     * @var integer
     */
    private $frequence;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $petite;

    /**
     * @var integer
     */
    private $moyenne;

    /**
     * @var integer
     */
    private $grande;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AdministrationBundle\Entity\Nomenclature
     */
    private $nomenclature;
    
    /**
     * @var \IC\AdministrationBundle\Entity\SousTypeLecteur
     */
    private $sousTypeLecteur;

    /**
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return TypeLecteur
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
     * Set designation
     *
     * @param string $designation
     *
     * @return TypeLecteur
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set frequence
     *
     * @param integer $frequence
     *
     * @return TypeLecteur
     */
    public function setFrequence($frequence)
    {
        $this->frequence = $frequence;

        return $this;
    }

    /**
     * Get frequence
     *
     * @return integer
     */
    public function getFrequence()
    {
        return $this->frequence;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return TypeLecteur
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set petite
     *
     * @param integer $petite
     *
     * @return TypeLecteur
     */
    public function setPetite($petite)
    {
        $this->petite = $petite;

        return $this;
    }

    /**
     * Get petite
     *
     * @return integer
     */
    public function getPetite()
    {
        return $this->petite;
    }

    /**
     * Set moyenne
     *
     * @param integer $moyenne
     *
     * @return TypeLecteur
     */
    public function setMoyenne($moyenne)
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    /**
     * Get moyenne
     *
     * @return integer
     */
    public function getMoyenne()
    {
        return $this->moyenne;
    }

    /**
     * Set grande
     *
     * @param integer $grande
     *
     * @return TypeLecteur
     */
    public function setGrande($grande)
    {
        $this->grande = $grande;

        return $this;
    }

    /**
     * Get grande
     *
     * @return integer
     */
    public function getGrande()
    {
        return $this->grande;
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
     * @return TypeLecteur
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
     * Set sousTypeLecteur
     *
     * @param \IC\AdministrationBundle\Entity\SousType $sousTypeLecteur
     *
     * @return TypeLecteur
     */
    public function setSousTypeLecteur(\IC\AdministrationBundle\Entity\SousTypeLecteur $sousTypeLecteur = null)
    {
        $this->sousTypeLecteur = $sousTypeLecteur;

        return $this;
    }

    /**
     * Get sousTypeLecteur
     *
     * @return \IC\AdministrationBundle\Entity\SousTypeLecteur
     */
    public function getSousTypeLecteur()
    {
        return $this->sousTypeLecteur;
    }
}
