<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lot
 *
 * @ORM\Table(name="lot")
 * @ORM\Entity(repositoryClass="IC\AffichageBundle\Repository\LotRepository")
 */
class Lot
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
     * @ORM\Column(name="id_nomenclature", type="integer", nullable=false)
     */
    private $idNomenclature;



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
}
