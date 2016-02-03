<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LecteurAutreType extends AbstractType
{
    private $path;
    
    public function __construct($path = null)
    {
        $this->path = $path;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $choice_label)
    {
        $builder->setAction($this->getPath());
        
        $builder->add('reference', 'text', array('required' => true));
        $builder->add('designation', 'text', array('required' => true));
        
        $builder->add('frequence', 'choice', array('choices' => array(1 => '13,56MHz', 2 => '125KHz'),
                      'multiple' => false,
                      'expanded' => false));
                                        
        $builder->add('sousTypeLecteur', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\SousTypeLecteur',
                      'choice_label' => 'nom',
                      'multiple'  => false));
                      
        $builder->add('petite', 'choice', array('choices' => array(0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'),
                      'multiple' => false,
                      'expanded' => false));
                       
        $builder->add('moyenne', 'choice', array('choices' => array(0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'),
                      'multiple' => false,
                      'expanded' => false));
                      
        $builder->add('grande', 'choice', array('choices' => array(0 => '0', 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'),
                      'multiple' => false,
                      'expanded' => false));
                      
        $builder->add('idFournisseur', 'hidden');                     
                                                   
        $builder->add('submitLecteurAutre', 'submit');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\TypeLecteurAutre'));
    }
    
    public function getName()
    {
        return 'lecteurAutreType';
    }
    
    public function getPath()
    {
        return $this->path;
    }
}