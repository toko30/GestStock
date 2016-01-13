<?php

namespace IC\ApprovisionnementBundle\Entity;

/**
 * ApproLecteur
 */
class ApproLecteur
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
     * @var \IC\ApprovisionnementBundle\Entity\Appro
     */
    private $appro;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\TypeLecteur
     */
    private $typeLecteur;


    /**
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return ApproLecteur
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
     * @return ApproLecteur
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
     * @return ApproLecteur
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
     * @param \IC\ApprovisionnementBundle\Entity\Appro $appro
     *
     * @return ApproLecteur
     */
    public function setAppro(\IC\ApprovisionnementBundle\Entity\Appro $appro = null)
    {
        $this->appro = $appro;

        return $this;
    }

    /**
     * Get appro
     *
     * @return \IC\ApprovisionnementBundle\Entity\Appro
     */
    public function getAppro()
    {
        return $this->appro;
    }

    /**
     * Set typeLecteur
     *
     * @param \IC\ApprovisionnementBundle\Entity\TypeLecteur $typeLecteur
     *
     * @return ApproLecteur
     */
    public function setTypeLecteur(\IC\ApprovisionnementBundle\Entity\TypeLecteur $typeLecteur = null)
    {
        $this->typeLecteur = $typeLecteur;

        return $this;
    }

    /**
     * Get typeLecteur
     *
     * @return \IC\ApprovisionnementBundle\Entity\TypeLecteur
     */
    public function getTypeLecteur()
    {
        return $this->typeLecteur;
    }
}

