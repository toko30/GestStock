<?php

namespace IC\AffichageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestNomenclature
 *
 * @ORM\Table(name="test_nomenclature")
 * @ORM\Entity
 */
class TestNomenclature
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
     * @var integer
     *
     * @ORM\Column(name="id_liste_test", type="integer", nullable=false)
     */
    private $idListeTest;



    /**
     * Set idNomenclature
     *
     * @param integer $idNomenclature
     *
     * @return TestNomenclature
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
     * Set idListeTest
     *
     * @param integer $idListeTest
     *
     * @return TestNomenclature
     */
    public function setIdListeTest($idListeTest)
    {
        $this->idListeTest = $idListeTest;

        return $this;
    }

    /**
     * Get idListeTest
     *
     * @return integer
     */
    public function getIdListeTest()
    {
        return $this->idListeTest;
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
