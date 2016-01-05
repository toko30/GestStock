<?php

namespace IC\ApprovisionnementBundle\Entity;

/**
 * Appro
 */
class Appro
{
    /**
     * @var integer
     */
    private $idFournisseur;

    /**
     * @var integer
     */
    private $idLieu;

    /**
     * @var \DateTime
     */
    private $dateCommande;

    /**
     * @var integer
     */
    private $typeProduit;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\SousTraitant
     */
    private $sousTraitant;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\Fournisseur
     */
    private $fournisseur;


    /**
     * Set idFournisseur
     *
     * @param integer $idFournisseur
     *
     * @return Appro
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
     * Set idLieu
     *
     * @param integer $idLieu
     *
     * @return Appro
     */
    public function setIdLieu($idLieu)
    {
        $this->idLieu = $idLieu;

        return $this;
    }

    /**
     * Get idLieu
     *
     * @return integer
     */
    public function getIdLieu()
    {
        return $this->idLieu;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return Appro
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set typeProduit
     *
     * @param integer $typeProduit
     *
     * @return Appro
     */
    public function setTypeProduit($typeProduit)
    {
        $this->typeProduit = $typeProduit;

        return $this;
    }

    /**
     * Get typeProduit
     *
     * @return integer
     */
    public function getTypeProduit()
    {
        return $this->typeProduit;
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
     * Set sousTraitant
     *
     * @param \IC\ApprovisionnementBundle\Entity\SousTraitant $sousTraitant
     *
     * @return Appro
     */
    public function setSousTraitant(\IC\ApprovisionnementBundle\Entity\SousTraitant $sousTraitant = null)
    {
        $this->sousTraitant = $sousTraitant;

        return $this;
    }

    /**
     * Get sousTraitant
     *
     * @return \IC\ApprovisionnementBundle\Entity\SousTraitant
     */
    public function getSousTraitant()
    {
        return $this->sousTraitant;
    }

    /**
     * Set fournisseur
     *
     * @param \IC\ApprovisionnementBundle\Entity\Fournisseur $fournisseur
     *
     * @return Appro
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
