<?php

namespace IC\ProductionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use IC\ProductionBundle\Repository\VersionNomenclatureRepository;

class ProductionType extends AbstractType
{
    private $versionNomenclature;
    public function __construct($versionNomenclature)
    {
        $this->versionNomenclature = $versionNomenclature;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $choice_label)
    {
        foreach($this->getVersionNomenclature() AS $VersionNom)
            $choixVersion[$VersionNom->getId()] = $VersionNom->getNomenclature()->getNom().'-V'.$VersionNom->getVersion();
            
        $builder->add('quantite', 'text', array('required' => false));
        $builder->add('versionNomenclature', 'choice', array('choices' => $choixVersion,
                      'multiple' => false,
                      'expanded' => false,
                      'empty_data'  => 0));

        $builder->add('calculer', 'submit');
    }

    public function getName()
    {
        return 'formProduction';
    }
    
    public function getVersionNomenclature()
    {
        return $this->versionNomenclature;
    }
}