<?php

namespace IC\ProductionBundle\Entity;

/**
 * Lot
 */
class Lot
{
    /**
     * @var integer
     */
    private $idNomenclature;

    /**
     * @var \DateTime
     */
    private $dateProd;

    /**
     * @var \DateTime
     */
    private $dateTest;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return Lot
     */
    public function setIdNomenclature($idNomenclature)
    {
        $this->idNomenclature = $idNomenclature;

        return $this;
    }

    /**
     * Get idNomenclature
     *
     * @return integer
     */
    public function getIdNomenclature()
    {
        return $this->idNomenclature;
    }

    /**
     * Set dateProd
     *
     * @param \DateTime $dateProd
     *
     * @return Lot
     */
    public function setDateProd($dateProd)
    {
        $this->dateProd = $dateProd;

        return $this;
    }

    /**
     * Get dateProd
     *
     * @return \DateTime
     */
    public function getDateProd()
    {
        return $this->dateProd;
    }

    /**
     * Set dateTest
     *
     * @param \DateTime $dateTest
     *
     * @return Lot
     */
    public function setDateTest($dateTest)
    {
        $this->dateTest = $dateTest;

        return $this;
    }

    /**
     * Get dateTest
     *
     * @return \DateTime
     */
    public function getDateTest()
    {
        return $this->dateTest;
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

