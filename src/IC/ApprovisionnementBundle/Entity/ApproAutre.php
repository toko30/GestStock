<?php

namespace IC\ApprovisionnementBundle\Entity;

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
    private $idAutre;

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
     * @var \IC\ApprovisionnementBundle\Entity\Autre
     */
    private $autre;


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
     * Set idAutre
     *
     * @param integer $idAutre
     *
     * @return ApproAutre
     */
    public function setIdAutre($idAutre)
    {
        $this->idAutre = $idAutre;

        return $this;
    }

    /**
     * Get idAutre
     *
     * @return integer
     */
    public function getIdAutre()
    {
        return $this->idAutre;
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
     * @param \IC\ApprovisionnementBundle\Entity\Appro $appro
     *
     * @return ApproAutre
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
     * Set autre
     *
     * @param \IC\ApprovisionnementBundle\Entity\Autre $autre
     *
     * @return ApproAutre
     */
    public function setAutre(\IC\ApprovisionnementBundle\Entity\Autre $autre = null)
    {
        $this->autre = $autre;

        return $this;
    }

    /**
     * Get autre
     *
     * @return \IC\ApprovisionnementBundle\Entity\Autre
     */
    public function getAutre()
    {
        return $this->autre;
    }
}

