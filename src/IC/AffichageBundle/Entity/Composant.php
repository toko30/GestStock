<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composant
 *
 * @ORM\Table(name="composant")
 * @ORM\Entity
 */
class Composant
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
     * @ORM\Column(name="nom", type="string", length=250, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="text", length=65535, nullable=false)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="boitier", type="string", length=100, nullable=true)
     */
    private $boitier;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_interne", type="integer", nullable=false)
     */
    private $stockInterne;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_mini", type="integer", nullable=false)
     */
    private $stockMini;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_famille", type="integer", nullable=false)
     */
    private $idFamille;



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
     * Set nom
     *
     * @param string $nom
     *
     * @return Composant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set info
     *
     * @param string $info
     *
     * @return Composant
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set boitier
     *
     * @param string $boitier
     *
     * @return Composant
     */
    public function setBoitier($boitier)
    {
        $this->boitier = $boitier;

        return $this;
    }

    /**
     * Get boitier
     *
     * @return string
     */
    public function getBoitier()
    {
        return $this->boitier;
    }

    /**
     * Set stockInterne
     *
     * @param integer $stockInterne
     *
     * @return Composant
     */
    public function setStockInterne($stockInterne)
    {
        $this->stockInterne = $stockInterne;

        return $this;
    }

    /**
     * Get stockInterne
     *
     * @return integer
     */
    public function getStockInterne()
    {
        return $this->stockInterne;
    }

    /**
     * Set stockSt
     *
     * @param integer $stockSt
     *
     * @return Composant
     */
    public function setStockSt($stockSt)
    {
        $this->stockSt = $stockSt;

        return $this;
    }

    /**
     * Get stockSt
     *
     * @return integer
     */
    public function getStockSt()
    {
        return $this->stockSt;
    }

    /**
     * Set stockMini
     *
     * @param integer $stockMini
     *
     * @return Composant
     */
    public function setStockMini($stockMini)
    {
        $this->stockMini = $stockMini;

        return $this;
    }

    /**
     * Get stockMini
     *
     * @return integer
     */
    public function getStockMini()
    {
        return $this->stockMini;
    }

    /**
     * Set idFamille
     *
     * @param integer $idFamille
     *
     * @return Composant
     */
    public function setIdFamille($idFamille)
    {
        $this->idFamille = $idFamille;

        return $this;
    }

    /**
     * Get idFamille
     *
     * @return integer
     */
    public function getIdFamille()
    {
        return $this->idFamille;
    }
}
