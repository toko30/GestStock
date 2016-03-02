<?php

namespace IC\AffichageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProduitFiniLecteurType extends AbstractType
{
  private $type;
  
  public function __construct($type)
  {
    $this->type = $type;
  }
  
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    foreach($this->getType() AS $type)
      $choixType[] = $type->getNom();
      
    $builder->add('recherche', 'text', array('required' => false));
                                   
    $builder->add('type', 'choice', array('choices' => $choixType,
                'multiple' => true,
                'expanded' => true,
                'empty_data'  => 0));
                
    $builder->add('frequence', 'choice', array('choices' => array('125 KHz', '13,56 MHz'),
                'multiple' => true,
                'expanded' => true,
                'empty_data'  => 0));                              
              
   $builder->add('Rechercher', 'submit');                                                 
    $builder->add('Trier', 'submit');
  }

  public function getName()
  {
    return 'formProduitFiniLecteur';
  }
  
  public function getType()
  {
    return $this->type;
  }
}
