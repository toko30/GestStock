<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sav
 *
 * @ORM\Table(name="sav")
 * @ORM\Entity
 */
class Sav
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
     * @ORM\Column(name="etape", type="integer", nullable=true)
     */
    private $etape;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reception", type="date", nullable=false)
     */
    private $dateReception;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_renvoi", type="date", nullable=false)
     */
    private $dateRenvoi;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text", length=65535, nullable=true)
     */
    private $commentaire;



    /**
     * Set numSerie
     *
     * @param string $numSerie
     *
     * @return Sav
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
     * Set etape
     *
     * @param integer $etape
     *
     * @return Sav
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;

        return $this;
    }

    /**
     * Get etape
     *
     * @return integer
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Sav
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
     * Set dateReception
     *
     * @param \DateTime $dateReception
     *
     * @return Sav
     */
    public function setDateReception($dateReception)
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    /**
     * Get dateReception
     *
     * @return \DateTime
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * Set dateRenvoi
     *
     * @param \DateTime $dateRenvoi
     *
     * @return Sav
     */
    public function setDateRenvoi($dateRenvoi)
    {
        $this->dateRenvoi = $dateRenvoi;

        return $this;
    }

    /**
     * Get dateRenvoi
     *
     * @return \DateTime
     */
    public function getDateRenvoi()
    {
        return $this->dateRenvoi;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Sav
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
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
