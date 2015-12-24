<?php

namespace IC\AffichageBundle\Entity;

/**
 * ComposantSousTraitant
 */
class ComposantSousTraitant
{
    /**
     * @var integer
     */
    private $idSousTraitant;

    /**
     * @var integer
     */
    private $idComposant;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AffichageBundle\Entity\Composant
     */
    private $composant;

    /**
     * @var \IC\AffichageBundle\Entity\SousTraitant
     */
    private $sousTraitant;


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
     * @return ComposantSousTraitant
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
     * Set sousTraitant
     *
     * @param \IC\AffichageBundle\Entity\SousTraitant $sousTraitant
     *
     * @return ComposantSousTraitant
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
}
