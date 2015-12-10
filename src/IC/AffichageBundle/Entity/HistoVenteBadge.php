<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoVenteBadge
 *
 * @ORM\Table(name="histo_vente_badge")
 * @ORM\Entity(repositoryClass="IC\AffichageBundle\Repository\HistoVenteBadgeRepository")
 */
class HistoVenteBadge
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
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_type_badge", type="integer", nullable=true)
     */
    private $idTypeBadge;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_vente", type="date", nullable=true)
     */
    private $dateVente;



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
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return HistoVenteBadge
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return integer
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set idTypeBadge
     *
     * @param integer $idTypeBadge
     *
     * @return HistoVenteBadge
     */
    public function setIdTypeBadge($idTypeBadge)
    {
        $this->idTypeBadge = $idTypeBadge;

        return $this;
    }

    /**
     * Get idTypeBadge
     *
     * @return integer
     */
    public function getIdTypeBadge()
    {
        return $this->idTypeBadge;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return HistoVenteBadge
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
     * Set dateVente
     *
     * @param \DateTime $dateVente
     *
     * @return HistoVenteBadge
     */
    public function setDateVente($dateVente)
    {
        $this->dateVente = $dateVente;

        return $this;
    }

    /**
     * Get dateVente
     *
     * @return \DateTime
     */
    public function getDateVente()
    {
        return $this->dateVente;
    }
}
