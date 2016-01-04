<?php

namespace IC\ApprovisionnementBundle\Entity;

/**
 * ApproIdentifiant
 */
class ApproIdentifiant
{
    /**
     * @var integer
     */
    private $idCommande;

    /**
     * @var integer
     */
    private $idIdentifiant;

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
     * @var \IC\ApprovisionnementBundle\Entity\TypeBadge
     */
    private $typeBadge;


    /**
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return ApproIdentifiant
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
     * Set idIdentifiant
     *
     * @param integer $idIdentifiant
     *
     * @return ApproIdentifiant
     */
    public function setIdIdentifiant($idIdentifiant)
    {
        $this->idIdentifiant = $idIdentifiant;

        return $this;
    }

    /**
     * Get idIdentifiant
     *
     * @return integer
     */
    public function getIdIdentifiant()
    {
        return $this->idIdentifiant;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ApproIdentifiant
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
     * @return ApproIdentifiant
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
     * Set typeBadge
     *
     * @param \IC\ApprovisionnementBundle\Entity\TypeBadge $typeBadge
     *
     * @return ApproIdentifiant
     */
    public function setTypeBadge(\IC\ApprovisionnementBundle\Entity\TypeBadge $typeBadge = null)
    {
        $this->typeBadge = $typeBadge;

        return $this;
    }

    /**
     * Get typeBadge
     *
     * @return \IC\ApprovisionnementBundle\Entity\TypeBadge
     */
    public function getTypeBadge()
    {
        return $this->typeBadge;
    }
}

