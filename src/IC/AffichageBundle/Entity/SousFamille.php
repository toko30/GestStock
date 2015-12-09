<?php

namespace IC\AffichageBundle\Entity;

/**
 * sous_famille
 */
class SousFamille
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idFamille;

    /**
     * @var string
     */
    private $nom;


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
     * Set idFamille
     *
     * @param integer $idFamille
     *
     * @return sous_famille
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
     * Set nom
     *
     * @param string $nom
     *
     * @return sous_famille
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
}

