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
     * @var integer
     */
    private $idCommande;

    /**
     * @var integer
     */
    private $idProduit;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var integer
     */
    private $lieu;

    /**
     * @var integer
     */
    private $etat;

    /**
     * @var \IC\AffichageBundle\Entity\Composant
     */
    private $composant;

    /**
     * @var \IC\AffichageBundle\Entity\ComposantAppro
     */
    private $composantAppro;


    /**
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return Appro
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    /**
     * Get idCommande
     *
     * @return integer
     */
    public function getIdCommande()
    {
        return $this->idCommande;
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
     * Set idProduit
     *
     * @param integer $idProduit
     *
     * @return Appro
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get idProduit
     *
     * @return integer
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Appro
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
     * Set lieu
     *
     * @param integer $lieu
     *
     * @return Appro
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return integer
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Appro
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
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
     * @param \IC\AffichageBundle\Entity\Composant $composant
     *
     * @return Appro
     */
    public function setComposant(\IC\AffichageBundle\Entity\Composant $composant = null)
    {
        $this->composant = $composant;

        return $this;
    }

    /**
     * Get composant
     *
     * @return \IC\AffichageBundle\Entity\Composant
     */
    public function getComposant()
    {
        return $this->composant;
    }

    /**
     * Set composantAppro
     *
     * @param \IC\AffichageBundle\Entity\ComposantAppro $composantAppro
     *
     * @return Appro
     */
    public function setComposantAppro(\IC\AffichageBundle\Entity\ComposantAppro $composantAppro = null)
    {
        $this->composantAppro = $composantAppro;

        return $this;
    }

    /**
     * Get composantAppro
     *
     * @return \IC\AffichageBundle\Entity\ComposantAppro
     */
    public function getComposantAppro()
    {
        return $this->composantAppro;
    }
}
