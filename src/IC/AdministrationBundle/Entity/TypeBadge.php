<?php

namespace IC\AdministrationBundle\Entity;

/**
 * TypeBadge
 */
class TypeBadge
{
    /**
     * @var string
     */
    private $reference;

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
    private $idFournisseur;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AdministrationBundle\Entity\SousTypeBadge
     */
    private $sousTypeBadge;
    
    /**
     * @var \IC\AdministrationBundle\Entity\Fournisseur
     */
    private $fournisseur;

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return TypeBadge
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return TypeBadge
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
     * @return TypeBadge
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
     * @return TypeBadge
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
     * Set idFournisseur
     *
     * @param integer $idFournisseur
     *
     * @return TypeBadge
     */
    public function setIdFournisseur($idFournisseur)
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    /**
     * Get idFournisseur
     *
     * @return integer
     */
    public function getIdFournisseur()
    {
        return $this->idFournisseur;
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
     * Set sousTypeBadge
     *
     * @param \IC\AdministrationBundle\Entity\SousTypeBadge $sousTypeBadge
     *
     * @return TypeBadge
     */
    public function setSousTypeBadge(\IC\AdministrationBundle\Entity\SousTypeBadge $sousTypeBadge = null)
    {
        $this->sousTypeBadge = $sousTypeBadge;

        return $this;
    }

    /**
     * Get sousTypeBadge
     *
     * @return \IC\AdministrationBundle\Entity\SousTypeBadge
     */
    public function getSousTypeBadge()
    {
        return $this->sousTypeBadge;
    }

    /**
     * Set fournisseur
     *
     * @param \IC\AdministrationBundle\Entity\Fournisseur $fournisseur
     *
     * @return TypeBadge
     */
    public function setFournisseur(\IC\AdministrationBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \IC\AdministrationBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }
}
