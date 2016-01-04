<?php

namespace IC\AffichageBundle\Entity;

/**
 * ApproAutre
 */
class ApproAutre
{
    /**
     * @var integer
     */
    private $idCommande;

    /**
     * @var integer
     */
    private $idLecteur;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\AffichageBundle\Entity\Appro
     */
    private $appro;

    /**
     * @var \IC\AffichageBundle\Entity\TypeLecteur
     */
    private $typeLecteur;


    /**
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return ApproAutre
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
     * Set idLecteur
     *
     * @param integer $idLecteur
     *
     * @return ApproAutre
     */
    public function setIdLecteur($idLecteur)
    {
        $this->idLecteur = $idLecteur;

        return $this;
    }

    /**
     * Get idLecteur
     *
     * @return integer
     */
    public function getIdLecteur()
    {
        return $this->idLecteur;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ApproAutre
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
     * @return ApproAutre
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
     * Set typeLecteur
     *
     * @param \IC\AffichageBundle\Entity\TypeLecteur $typeLecteur
     *
     * @return ApproAutre
     */
    public function setTypeLecteur(\IC\AffichageBundle\Entity\TypeLecteur $typeLecteur = null)
    {
        $this->typeLecteur = $typeLecteur;

        return $this;
    }

    /**
     * Get typeLecteur
     *
     * @return \IC\AffichageBundle\Entity\TypeLecteur
     */
    public function getTypeLecteur()
    {
        return $this->typeLecteur;
    }
}
