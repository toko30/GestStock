<?php

namespace IC\AffichageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComposantInterneType extends AbstractType
{
  private $famille;
  private $sousFamille;
  
  public function __construct($fam, $sousFam)
  {
    $this->fam = $fam;
    $this->sousFam = $sousFam;
  }
  
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
          
    $builder->add('recherche', 'text');
    
    foreach($this->getFam() AS $famille)
      $choixFamille[] = $famille->getNom();
      
    foreach($this->getSousFam() AS $sousFamille)
      $choixSousFamille[] = $sousFamille->getNom();   
        
$builder->add('Famille', 'choice', array('choices' => $choixFamille,
            'multiple' => true,
            'expanded' => true,
            'preferred_choices' => array(2),
            'empty_data'  => 0));
            
$builder->add('sousFamille', 'choice', array('choices' => $choixSousFamille,
            'multiple' => true,
            'expanded' => true,
            'preferred_choices' => array(2),
            'empty_data'  => 0));         
        
    $builder->add('Trier', 'submit');
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'IC\AffichageBundle\Form\MenuCompInterne'
    ));
  }

  public function getName()
  {
    return 'form';
  }
    public function getFam()
  {
    return $this->fam;
  }
    public function getSousFam()
  {
     return $this->sousFam;
  }
}