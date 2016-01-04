<?php

namespace IC\ApprovisionnementBundle\Entity;

/**
 * ApproComposant
 */
class ApproComposant
{
    /**
     * @var integer
     */
    private $idCommande;

    /**
     * @var integer
     */
    private $idProduit;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\Composant
     */
    private $composant;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\Appro
     */
    private $appro;


    /**
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return ApproComposant
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
     * Set idProduit
     *
     * @param integer $idProduit
     *
     * @return ApproComposant
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;

        return $this;
    }

    /**
     * Get idProduit
     *
     * @return integer
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ApproComposant
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
     * @param \IC\ApprovisionnementBundle\Entity\Composant $composant
     *
     * @return ApproComposant
     */
    public function setComposant(\IC\ApprovisionnementBundle\Entity\Composant $composant = null)
    {
        $this->composant = $composant;

        return $this;
    }

    /**
     * Get composant
     *
     * @return \IC\ApprovisionnementBundle\Entity\Composant
     */
    public function getComposant()
    {
        return $this->composant;
    }

    /**
     * Set appro
     *
     * @param \IC\ApprovisionnementBundle\Entity\Appro $appro
     *
     * @return ApproComposant
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
}

