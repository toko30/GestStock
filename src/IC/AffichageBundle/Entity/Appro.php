<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appro
 *
 * @ORM\Table(name="appro")
 * @ORM\Entity
 */
class Appro
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
     * @var integer
     *
     * @ORM\Column(name="id_fournisseur", type="integer", nullable=false)
     */
    private $idFournisseur;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_lieu", type="integer", nullable=false)
     */
    private $idLieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="date", nullable=false)
     */
    private $dateCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_produit", type="integer", nullable=false)
     */
    private $typeProduit;


    /**
     * @var \IC\AffichageBundle\Entity\SousTraitant
     */
    private $sousTraitant;

    /**
     * @var \IC\AffichageBundle\Entity\Fournisseur
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
     * @param \IC\AffichageBundle\Entity\SousTraitant $sousTraitant
     *
     * @return Appro
     */
    public function setSousTraitant(\IC\AffichageBundle\Entity\SousTraitant $sousTraitant = null)
    {
        $this->sousTraitant = $sousTraitant;

        return $this;
    }

    /**
     * Get sousTraitant
     *
     * @return \IC\AffichageBundle\Entity\SousTraitant
     */
    public function getSousTraitant()
    {
        return $this->sousTraitant;
    }

    /**
     * Set fournisseur
     *
     * @param \IC\AffichageBundle\Entity\Fournisseur $fournisseur
     *
     * @return Appro
     */
    public function setFournisseur(\IC\AffichageBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \IC\AffichageBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }
}
