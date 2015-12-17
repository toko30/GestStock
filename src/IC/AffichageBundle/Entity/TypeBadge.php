<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeBadge
 *
 * @ORM\Table(name="type_badge")
 * @ORM\Entity
 */
class TypeBadge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=100, nullable=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="text", length=65535, nullable=false)
     */
    private $designation;

    /**
     * @var integer
     *
     * @ORM\Column(name="frequence", type="integer", nullable=false)
     */
    private $frequence;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_fournisseur", type="integer", nullable=false)
     */
    private $idFournisseur;


    /**
     * @var \IC\AffichageBundle\Entity\SousTypeBadge
     */
    private $sousTypeBadge;


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
     * @param \IC\AffichageBundle\Entity\SousTypeBadge $sousTypeBadge
     *
     * @return TypeBadge
     */
    public function setSousTypeBadge(\IC\AffichageBundle\Entity\SousTypeBadge $sousTypeBadge = null)
    {
        $this->sousTypeBadge = $sousTypeBadge;

        return $this;
    }

    /**
     * Get sousTypeBadge
     *
     * @return \IC\AffichageBundle\Entity\SousTypeBadge
     */
    public function getSousTypeBadge()
    {
        return $this->sousTypeBadge;
    }
}
