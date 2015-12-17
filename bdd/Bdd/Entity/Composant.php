<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composant
 *
 * @ORM\Table(name="composant", indexes={@ORM\Index(name="famille", columns={"id_famille"})})
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
     * @ORM\Column(name="id_sous_famille", type="integer", nullable=false)
     */
    private $idSousFamille;

    /**
     * @var \Famille
     *
     * @ORM\ManyToOne(targetEntity="Famille")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_famille", referencedColumnName="id")
     * })
     */
    private $idFamille;


    /**
     * @var \IC\AffichageBundle\Entity\Famille
     */
    private $famille;

    /**
     * @var \IC\AffichageBundle\Entity\SousFamille
     */
    private $sousFamille;


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

    /**
     * Set idSousFamille
     *
     * @param integer $idSousFamille
     *
     * @return Composant
     */
    public function setIdSousFamille($idSousFamille)
    {
        $this->idSousFamille = $idSousFamille;

        return $this;
    }

    /**
     * Get idSousFamille
     *
     * @return integer
     */
    public function getIdSousFamille()
    {
        return $this->idSousFamille;
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
     * Set famille
     *
     * @param \IC\AffichageBundle\Entity\Famille $famille
     *
     * @return Composant
     */
    public function setFamille(\IC\AffichageBundle\Entity\Famille $famille = null)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return \IC\AffichageBundle\Entity\Famille
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set sousFamille
     *
     * @param \IC\AffichageBundle\Entity\SousFamille $sousFamille
     *
     * @return Composant
     */
    public function setSousFamille(\IC\AffichageBundle\Entity\SousFamille $sousFamille = null)
    {
        $this->sousFamille = $sousFamille;

        return $this;
    }

    /**
     * Get sousFamille
     *
     * @return \IC\AffichageBundle\Entity\SousFamille
     */
    public function getSousFamille()
    {
        return $this->sousFamille;
    }
}
