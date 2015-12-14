<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComposantNomenclature
 *
 * @ORM\Table(name="composant_nomenclature")
 * @ORM\Entity(repositoryClass="IC\AffichageBundle\Repository\ComposantNomenclatureRepository")
 */
class ComposantNomenclature
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
     * @ORM\Column(name="id_composant", type="integer", nullable=false)
     */
    private $idComposant;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nomenclature", type="integer", nullable=false)
     */
    private $idNomenclature;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="sous_type", type="integer", nullable=false)
     */
    private $sousType;



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
     * Set idComposant
     *
     * @param integer $idComposant
     *
     * @return ComposantNomenclature
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
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return ComposantNomenclature
     */
    public function setIdNomenclature($idNomenclature)
    {
        $this->idNomenclature = $idNomenclature;

        return $this;
    }

    /**
     * Get idNomenclature
     *
     * @return integer
     */
    public function getIdNomenclature()
    {
        return $this->idNomenclature;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ComposantNomenclature
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
     * @return ComposantNomenclature
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
     * Set sousType
     *
     * @param integer $sousType
     *
     * @return ComposantNomenclature
     */
    public function setSousType($sousType)
    {
        $this->sousType = $sousType;

        return $this;
    }

    /**
     * Get sousType
     *
     * @return integer
     */
    public function getSousType()
    {
        return $this->sousType;
    }
}
