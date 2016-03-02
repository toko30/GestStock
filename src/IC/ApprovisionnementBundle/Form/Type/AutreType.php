<?php

namespace IC\ApprovisionnementBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AutreType extends AbstractType
{
    private $typeLecteur;
    private $typeAutre;
    
    public function __construct($typeL, $typeA)
    {
        $this->typeLecteur = $typeL;
        $this->typeAutre = $typeA;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        foreach($this->getTypeLecteur() AS $type)
            $choixTypeLecteur[] = $type->getNom(); 
             
        foreach($this->getTypeAutre() AS $type)
            $choixTypeAutre[] = $type->getNom();  
                                  
        $builder->add('type', 'choice', array('choices' => array('Lecteur', 'Autre'),
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0));
                        
        $builder->add('typeLecteur', 'choice', array('choices' => $choixTypeLecteur,
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0));
                    
        $builder->add('typeAutre', 'choice', array('choices' => $choixTypeAutre,
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0));
                                        
        $builder->add('Trier', 'submit');
    }

    public function getName()
    {
        return 'formApproIdentifiant';
    }

    public function getTypeLecteur()
    {
        return $this->typeLecteur;
    }
    public function getTypeAutre()
    {
        return $this->typeAutre;
    }
}