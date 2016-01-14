<?php

namespace IC\ApprovisionnementBundle\Entity;

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
    private $idFournisseur;

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
     * @var \IC\ApprovisionnementBundle\Entity\TypeAutre
     */
    private $typeAutre;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\Fournisseur
     */
    private $fournisseur;


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
     * Set idFournisseur
     *
     * @param integer $idFournisseur
     *
     * @return Autre
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
     * @param \IC\ApprovisionnementBundle\Entity\TypeAutre $typeAutre
     *
     * @return Autre
     */
    public function setTypeAutre(\IC\ApprovisionnementBundle\Entity\TypeAutre $typeAutre = null)
    {
        $this->typeAutre = $typeAutre;

        return $this;
    }

    /**
     * Get typeAutre
     *
     * @return \IC\ApprovisionnementBundle\Entity\TypeAutre
     */
    public function getTypeAutre()
    {
        return $this->typeAutre;
    }

    /**
     * Set fournisseur
     *
     * @param \IC\ApprovisionnementBundle\Entity\Fournisseur $fournisseur
     *
     * @return Autre
     */
    public function setFournisseur(\IC\ApprovisionnementBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \IC\ApprovisionnementBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }
}
