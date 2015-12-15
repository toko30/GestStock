<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ApproIdentifiant
 *
 * @ORM\Table(name="appro_identifiant")
 * @ORM\Entity
 */
class ApproIdentifiant
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
     * @ORM\Column(name="id_commande", type="integer", nullable=false)
     */
    private $idCommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_identifiant", type="integer", nullable=false)
     */
    private $idIdentifiant;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;


    /**
     * @var \IC\AffichageBundle\Entity\Appro
     */
    private $appro;

    /**
     * @var \IC\AffichageBundle\Entity\TypeBadge
     */
    private $typeBadge;


    /**
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return ApproIdentifiant
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
     * Set idIdentifiant
     *
     * @param integer $idIdentifiant
     *
     * @return ApproIdentifiant
     */
    public function setIdIdentifiant($idIdentifiant)
    {
        $this->idIdentifiant = $idIdentifiant;

        return $this;
    }

    /**
     * Get idIdentifiant
     *
     * @return integer
     */
    public function getIdIdentifiant()
    {
        return $this->idIdentifiant;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ApproIdentifiant
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set appro
     *
     * @param \IC\AffichageBundle\Entity\Appro $appro
     *
     * @return ApproIdentifiant
     */
    public function setAppro(\IC\AffichageBundle\Entity\Appro $appro = null)
    {
        $this->appro = $appro;

        return $this;
    }

    /**
     * Get appro
     *
     * @return \IC\AffichageBundle\Entity\Appro
     */
    public function getAppro()
    {
        return $this->appro;
    }

    /**
     * Set typeBadge
     *
     * @param \IC\AffichageBundle\Entity\TypeBadge $typeBadge
     *
     * @return ApproIdentifiant
     */
    public function setTypeBadge(\IC\AffichageBundle\Entity\TypeBadge $typeBadge = null)
    {
        $this->typeBadge = $typeBadge;

        return $this;
    }

    /**
     * Get typeBadge
     *
     * @return \IC\AffichageBundle\Entity\TypeBadge
     */
    public function getTypeBadge()
    {
        return $this->typeBadge;
    }
}
