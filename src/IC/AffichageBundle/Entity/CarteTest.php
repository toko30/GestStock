<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarteTest
 *
 * @ORM\Table(name="carte_test")
 * @ORM\Entity
 */
class CarteTest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="num_serie", type="string", length=100, nullable=false)
     */
    private $numSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_lot", type="integer", nullable=false)
     */
    private $idLot;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="assemble", type="boolean", nullable=false)
     */
    private $assemble;



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
