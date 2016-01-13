<?php

namespace IC\ProductionBundle\Entity;

/**
 * CarteTest
 */
class CarteTest
{
    /**
     * @var string
     */
    private $numSerie;

    /**
     * @var integer
     */
    private $idLot;

    /**
     * @var integer
     */
    private $etat;

    /**
     * @var boolean
     */
    private $assemble;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set numSerie
     *
     * @param string $numSerie
     *
     * @return CarteTest
     */
    public function setNumSerie($numSerie)
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    /**
     * Get numSerie
     *
     * @return string
     */
    public function getNumSerie()
    {
        return $this->numSerie;
    }

    /**
     * Set idLot
     *
     * @param integer $idLot
     *
     * @return CarteTest
     */
    public function setIdLot($idLot)
    {
        $this->idLot = $idLot;

        return $this;
    }

    /**
     * Get idLot
     *
     * @return integer
     */
    public function getIdLot()
    {
        return $this->idLot;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return CarteTest
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return integer
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set assemble
     *
     * @param boolean $assemble
     *
     * @return CarteTest
     */
    public function setAssemble($assemble)
    {
        $this->assemble = $assemble;

        return $this;
    }

    /**
     * Get assemble
     *
     * @return boolean
     */
    public function getAssemble()
    {
        return $this->assemble;
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
