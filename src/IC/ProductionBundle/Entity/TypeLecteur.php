<?php

namespace IC\ProductionBundle\Entity;

/**
 * TypeLecteur
 */
class TypeLecteur
{
    /**
     * @var string
     */
    private $referenceInterne;

    /**
     * @var string
     */
    private $referenceFournisseur;

    /**
     * @var string
     */
    private $designation;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $frequence;

    /**
     * @var integer
     */
    private $idFournisseur;

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
     * Set referenceInterne
     *
     * @param string $referenceInterne
     *
     * @return TypeLecteur
     */
    public function setReferenceInterne($referenceInterne)
    {
        $this->referenceInterne = $referenceInterne;

        return $this;
    }

    /**
     * Get referenceInterne
     *
     * @return string
     */
    public function getReferenceInterne()
    {
        return $this->referenceInterne;
    }

    /**
     * Set referenceFournisseur
     *
     * @param string $referenceFournisseur
     *
     * @return TypeLecteur
     */
    public function setReferenceFournisseur($referenceFournisseur)
    {
        $this->referenceFournisseur = $referenceFournisseur;

        return $this;
    }

    /**
     * Get referenceFournisseur
     *
     * @return string
     */
    public function getReferenceFournisseur()
    {
        return $this->referenceFournisseur;
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
     * Set idFournisseur
     *
     * @param integer $idFournisseur
     *
     * @return TypeLecteur
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
}

