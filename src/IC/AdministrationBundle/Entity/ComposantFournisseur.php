<?php

namespace IC\AdministrationBundle\Entity;

/**
 * ComposantFournisseur
 */
class ComposantFournisseur
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var float
     */
    private $prix;

    /**
     * @var integer
     */
    private $idComposant;

    /**
     * @var integer
     */
    private $idFournisseur;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AdministrationBundle\Entity\Composant
     */
    private $composant;

    /**
     * @var \IC\AdministrationBundle\Entity\Fournisseur
     */
    private $fournisseur;


    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return ComposantFournisseur
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
     * Set prix
     *
     * @param float $prix
     *
     * @return ComposantFournisseur
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set idComposant
     *
     * @param integer $idComposant
     *
     * @return ComposantFournisseur
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
     * Set idFournisseur
     *
     * @param integer $idFournisseur
     *
     * @return ComposantFournisseur
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
     * Set composant
     *
     * @param \IC\AdministrationBundle\Entity\Composant $composant
     *
     * @return ComposantFournisseur
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

    /**
     * Set fournisseur
     *
     * @param \IC\AdministrationBundle\Entity\Fournisseur $fournisseur
     *
     * @return ComposantFournisseur
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

