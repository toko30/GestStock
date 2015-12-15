<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeLecteur
 *
 * @ORM\Table(name="type_lecteur")
 * @ORM\Entity
 */
class TypeLecteur
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
     * @ORM\Column(name="reference_fournisseur", type="string", length=250, nullable=false)
     */
    private $referenceFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_interne", type="string", length=100, nullable=false)
     */
    private $referenceInterne;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="text", length=65535, nullable=false)
     */
    private $designation;

    /**
     * @var integer
     *
     * @ORM\Column(name="frequence", type="integer", nullable=false)
     */
    private $frequence;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_fournisseur", type="integer", nullable=false)
     */
    private $idFournisseur;

    /**
     * @var integer
     *
     * @ORM\Column(name="petite", type="integer", nullable=false)
     */
    private $petite;

    /**
     * @var integer
     *
     * @ORM\Column(name="moyenne", type="integer", nullable=false)
     */
    private $moyenne;

    /**
     * @var integer
     *
     * @ORM\Column(name="grande", type="integer", nullable=false)
     */
    private $grande;



    /**
     * Set referenceInterne
     *
     * @param string $referenceInterne
     *
     * @return TypeLecteur
     */
    public function setReferenceInterne($referenceInterne)
    {
        $this->referenceInterne = $referenceInterne;

        return $this;
    }

    /**
     * Get referenceInterne
     *
     * @return string
     */
    public function getReferenceInterne()
    {
        return $this->referenceInterne;
    }

    /**
     * Set referenceFournisseur
     *
     * @param string $referenceFournisseur
     *
     * @return TypeLecteur
     */
    public function setReferenceFournisseur($referenceFournisseur)
    {
        $this->referenceFournisseur = $referenceFournisseur;

        return $this;
    }

    /**
     * Get referenceFournisseur
     *
     * @return string
     */
    public function getReferenceFournisseur()
    {
        return $this->referenceFournisseur;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return TypeLecteur
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set idFournisseur
     *
     * @param integer $idFournisseur
     *
     * @return TypeLecteur
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
