<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousFamille
 *
 * @ORM\Table(name="sous_famille", indexes={@ORM\Index(name="sous_famille", columns={"id_famille"})})
 * @ORM\Entity
 */
class SousFamille
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
     * @ORM\Column(name="id_famille", type="integer", nullable=false)
     */
    private $idFamille;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, nullable=false)
     */
    private $nom;



    /**
     * Set idFamille
     *
     * @param integer $idFamille
     *
     * @return SousFamille
     */
    public function setIdFamille($idFamille)
    {
        $this->idFamille = $idFamille;

        return $this;
    }

    /**
     * Get idFamille
     *
     * @return integer
     */
    public function getIdFamille()
    {
        return $this->idFamille;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return SousFamille
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
