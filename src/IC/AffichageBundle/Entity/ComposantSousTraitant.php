<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComposantSousTraitant
 *
 * @ORM\Table(name="composant_sous_traitant")
 * @ORM\Entity
 */
class ComposantSousTraitant
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
     * @ORM\Column(name="id_sous_traitant", type="integer", nullable=true)
     */
    private $idSousTraitant;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_composant", type="integer", nullable=false)
     */
    private $idComposant;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;



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
     * Set idSousTraitant
     *
     * @param integer $idSousTraitant
     *
     * @return ComposantSousTraitant
     */
    public function setIdSousTraitant($idSousTraitant)
    {
        $this->idSousTraitant = $idSousTraitant;

        return $this;
    }

    /**
     * Get idSousTraitant
     *
     * @return integer
     */
    public function getIdSousTraitant()
    {
        return $this->idSousTraitant;
    }

    /**
     * Set idComposant
     *
     * @param integer $idComposant
     *
     * @return ComposantSousTraitant
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ComposantSousTraitant
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
}
