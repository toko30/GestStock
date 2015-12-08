<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ErreurTest
 *
 * @ORM\Table(name="erreur_test")
 * @ORM\Entity
 */
class ErreurTest
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
     * @ORM\Column(name="num_serie", type="string", length=250, nullable=false)
     */
    private $numSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_etape", type="integer", nullable=false)
     */
    private $idEtape;

    /**
     * @var integer
     *
     * @ORM\Column(name="reprise", type="integer", nullable=false)
     */
    private $reprise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_test", type="date", nullable=false)
     */
    private $dateTest;



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
     * Set numSerie
     *
     * @param string $numSerie
     *
     * @return ErreurTest
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
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ErreurTest
     */
    public function setIdEtape($idEtape)
    {
        $this->idEtape = $idEtape;

        return $this;
    }

    /**
     * Get idEtape
     *
     * @return integer
     */
    public function getIdEtape()
    {
        return $this->idEtape;
    }

    /**
     * Set reprise
     *
     * @param integer $reprise
     *
     * @return ErreurTest
     */
    public function setReprise($reprise)
    {
        $this->reprise = $reprise;

        return $this;
    }

    /**
     * Get reprise
     *
     * @return integer
     */
    public function getReprise()
    {
        return $this->reprise;
    }

    /**
     * Set dateTest
     *
     * @param \DateTime $dateTest
     *
     * @return ErreurTest
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
}
