<?php

namespace IC\AffichageBundle\Entity;

/**
 * Autre
 */
class Autre
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
    private $quantite;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AffichageBundle\Entity\TypeAutre
     */
    private $typeAutre;


    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Autre
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
     * @return Autre
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Autre
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
     * Set type
     *
     * @param integer $type
     *
     * @return Autre
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeAutre
     *
     * @param \IC\AffichageBundle\Entity\TypeAutre $typeAutre
     *
     * @return Autre
     */
    public function setTypeAutre(\IC\AffichageBundle\Entity\TypeAutre $typeAutre = null)
    {
        $this->typeAutre = $typeAutre;

        return $this;
    }

    /**
     * Get typeAutre
     *
     * @return \IC\AffichageBundle\Entity\TypeAutre
     */
    public function getTypeAutre()
    {
        return $this->typeAutre;
    }
}