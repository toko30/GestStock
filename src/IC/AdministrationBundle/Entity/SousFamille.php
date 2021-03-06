<?php

namespace IC\AdministrationBundle\Entity;

/**
 * SousFamille
 */
class SousFamille
{
    /**
     * @var integer
     */
    private $idFamille;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AdministrationBundle\Entity\Famille
     */
    private $famille;


    /**
     * Set idFamille
     *
     * @param integer $idFamille
     *
     * @return SousFamille
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
     * @return SousFamille
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
     * @param \IC\AdministrationBundle\Entity\Famille $famille
     *
     * @return SousFamille
     */
    public function setFamille(\IC\AdministrationBundle\Entity\Famille $famille = null)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return \IC\AdministrationBundle\Entity\Famille
     */
    public function getFamille()
    {
        return $this->famille;
    }
}
