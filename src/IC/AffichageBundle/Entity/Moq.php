<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moq
 *
 * @ORM\Table(name="moq")
 * @ORM\Entity
 */
class Moq
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
     * @var integer
     *
     * @ORM\Column(name="id_composant", type="integer", nullable=false)
     */
    private $idComposant;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_fournisseur", type="integer", nullable=false)
     */
    private $idFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="text", length=65535, nullable=false)
     */
    private $ref;

    /**
     * @var integer
     *
     * @ORM\Column(name="moq", type="integer", nullable=false)
     */
    private $moq;


    /**
     * @var \IC\AffichageBundle\Entity\Fournisseur
     */
    private $fournisseur;

    /**
     * @var \IC\AffichageBundle\Entity\Composant
     */
    private $composant;


    /**
     * Set idComposant
     *
     * @param integer $idComposant
     *
     * @return Moq
     */
    public function setIdComposant($idComposant)
    {
        $this->idComposant = $idComposant;

        return $this;
    }

    /**
     * Get idComposant
     *
     * @return integer
     */
    public function getIdComposant()
    {
        return $this->idComposant;
    }

    /**
     * Set idFournisseur
     *
     * @param integer $idFournisseur
     *
     * @return Moq
     */
    public function setIdFournisseur($idFournisseur)
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    /**
     * Get idFournisseur
     *
     * @return integer
     */
    public function getIdFournisseur()
    {
        return $this->idFournisseur;
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Moq
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set moq
     *
     * @param integer $moq
     *
     * @return Moq
     */
    public function setMoq($moq)
    {
        $this->moq = $moq;

        return $this;
    }

    /**
     * Get moq
     *
     * @return integer
     */
    public function getMoq()
    {
        return $this->moq;
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
     * Set fournisseur
     *
     * @param \IC\AffichageBundle\Entity\Fournisseur $fournisseur
     *
     * @return Moq
     */
    public function setFournisseur(\IC\AffichageBundle\Entity\Fournisseur $fournisseur = null)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get fournisseur
     *
     * @return \IC\AffichageBundle\Entity\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set composant
     *
     * @param \IC\AffichageBundle\Entity\Composant $composant
     *
     * @return Moq
     */
    public function setComposant(\IC\AffichageBundle\Entity\Composant $composant = null)
    {
        $this->composant = $composant;

        return $this;
    }

    /**
     * Get composant
     *
     * @return \IC\AffichageBundle\Entity\Composant
     */
    public function getComposant()
    {
        return $this->composant;
    }
}
