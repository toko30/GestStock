<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListeTest
 *
 * @ORM\Table(name="liste_test")
 * @ORM\Entity
 */
class ListeTest
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
     * @ORM\Column(name="nom", type="text", length=65535, nullable=false)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_etape", type="integer", nullable=false)
     */
    private $idEtape;



    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return ListeTest
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
     * Set idEtape
     *
     * @param integer $idEtape
     *
     * @return ListeTest
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
