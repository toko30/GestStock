<?php

namespace IC\ApprovisionnementBundle\Entity;

/**
 * Badge
 */
class Badge
{
    /**
     * @var integer
     */
    private $idType;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \IC\ApprovisionnementBundle\Entity\TypeBadge
     */
    private $typeBadge;


    /**
     * Set idType
     *
     * @param integer $idType
     *
     * @return Badge
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return integer
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Badge
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
     * Set typeBadge
     *
     * @param \IC\ApprovisionnementBundle\Entity\TypeBadge $typeBadge
     *
     * @return Badge
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

