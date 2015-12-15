<?php

namespace IC\AffichageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComposantSousTraitantType extends AbstractType
{
  private $famille;
  private $sousFamille;
  private $fournisseur;
  private $nomenclature;
  
  public function __construct($fam, $sousFam, $nom)
  {
    $this->fam = $fam;
    $this->sousFam = $sousFam;
    $this->nomenclature = $nom;
  }
  
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    foreach($this->getFam() AS $famille)
      $choixFamille[] = $famille->getNom();
      
    foreach($this->getSousFam() AS $sousFamille)
      $choixSousFamille[] = $sousFamille->getNom();   

    foreach($this->getNomenclature() AS $nomenclature)
      $choixNomenclature[] = $nomenclature->getNom(); 
      
    $builder->add('recherche', 'text', array('required' => false));
    
    $builder->add('choixRecherche', 'choice', array('choices' => array('Désignation', 'Référence'),
                  'multiple' => false,
                  'expanded' => true,
                  'empty_data'  => 0));
                                   
    $builder->add('famille', 'choice', array('choices' => $choixFamille,
                'multiple' => true,
                'expanded' => true,
                'empty_data'  => 0));
                
    $builder->add('sousFamille', 'choice', array('choices' => $choixSousFamille,
                'multiple' => true,
                'expanded' => true,
                'empty_data'  => 0));   
                               
    $builder->add('nomenclature', 'choice', array('choices' => $choixNomenclature,
                'multiple' => true,
                'expanded' => true,
                'empty_data'  => 0)); 

    $builder->add('stock', 'text', array('required' => false));
    $builder->add('plus_ou_moins', 'choice', array('choices' => array('Supérieur', 'Inférieur'),
              'multiple' => false,
              'expanded' => true,
              'empty_data'  => 0));    
              
   $builder->add('Rechercher', 'submit');                                                 
    $builder->add('Trier', 'submit');
  }

  public function getName()
  {
    return 'formComposantInterne';
  }
  
  public function getFam()
  {
    return $this->fam;
  }
  
  public function getSousFam()
  {
     return $this->sousFam;
  }
  
  public function getFournisseur()
  {
     return $this->fournisseur;
  }
  public function getNomenclature()
  {
     return $this->nomenclature;
  }
}