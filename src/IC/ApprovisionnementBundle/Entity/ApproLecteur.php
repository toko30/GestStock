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
     * @var \IC\ApprovisionnementBundle\Entity\TypeLecteurAutre
     */
    private $typeLecteurAutre;


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
     * Set typeLecteurAutre
     *
     * @param \IC\ApprovisionnementBundle\Entity\TypeLecteurAutre $typeLecteurAutre
     *
     * @return ApproLecteur
     */
    public function setTypeLecteurAutre(\IC\ApprovisionnementBundle\Entity\TypeLecteurAutre $typeLecteurAutre = null)
    {
        $this->typeLecteurAutre = $typeLecteurAutre;

        return $this;
    }

    /**
     * Get typeLecteur
     *
     * @return \IC\ApprovisionnementBundle\Entity\TypeLecteurAutre
     */
    public function getTypeLecteurAutre()
    {
        return $this->typeLecteurAutre;
    }
}

