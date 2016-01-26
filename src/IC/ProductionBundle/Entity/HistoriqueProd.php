<?php

namespace IC\ProductionBundle\Entity;

/**
 * HistoriqueProd
 */
class HistoriqueProd
{
    /**
     * @var integer
     */
    private $idNomenclature;

    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var \DateTime
     */
    private $dateProd;

    /**
     * @var integer
     */
    private $lieu;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return HistoriqueProd
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return HistoriqueProd
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
     * Set dateProd
     *
     * @param \DateTime $dateProd
     *
     * @return HistoriqueProd
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
     * Set lieu
     *
     * @param integer $lieu
     *
     * @return HistoriqueProd
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return integer
     */
    public function getLieu()
    {
        return $this->lieu;
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

