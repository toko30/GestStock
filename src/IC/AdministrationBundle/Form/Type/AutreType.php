<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutreType extends AbstractType
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
                      
        $builder->add('typeAutre', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\TypeAutre',
                      'choice_label' => 'nom',
                      'multiple'  => false));  
                      
        $builder->add('idFournisseur', 'hidden');  
                              
        $builder->add('submitAutre', 'submit');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\Autre'));
    }
    
    public function getName()
    {
        return 'autreType';
    }
    
    public function getPath()
    {
        return $this->path;
    }
}