<?php

namespace IC\ApprovisionnementBundle\Entity;

/**
 * Nomenclature
 */
class Nomenclature
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Nomenclature
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
     * Set version
     *
     * @param integer $version
     *
     * @return Nomenclature
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Nomenclature
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
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
}

