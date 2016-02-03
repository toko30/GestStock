<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdentifiantType extends AbstractType
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
                                        
        $builder->add('sousTypeBadge', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\SousTypeBadge',
                      'choice_label' => 'nom',
                      'multiple'  => false));       
                      
        $builder->add('idFournisseur', 'hidden'); 
                                  
        $builder->add('submitIdentifiant', 'submit');
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\TypeBadge'));
    }
    
    public function getName()
    {
        return 'identifiantType';
    }
    
    public function getPath()
    {
        return $this->path;
    }
}