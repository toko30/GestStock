<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComposantNomenclature
 *
 * @ORM\Table(name="composant_nomenclature")
 * @ORM\Entity
 */
class ComposantNomenclature
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @var string
     *
     * @ORM\Column(name="position", type="text", length=65535, nullable=false)
     */
    private $position;


    /**
     * @var \IC\AffichageBundle\Entity\Composant
     */
    private $composant;

    /**
     * @var \IC\AffichageBundle\Entity\Nomenclature
     */
    private $nomenclature;


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
     * @return ComposantNomenclature
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
     * Set nomenclature
     *
     * @param \IC\AffichageBundle\Entity\Nomenclature $nomenclature
     *
     * @return ComposantNomenclature
     */
    public function setNomenclature(\IC\AffichageBundle\Entity\Nomenclature $nomenclature = null)
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    /**
     * Get nomenclature
     *
     * @return \IC\AffichageBundle\Entity\Nomenclature
     */
    public function getNomenclature()
    {
        return $this->nomenclature;
    }
}
