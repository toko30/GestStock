<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateFournisseurType extends AbstractType
{
    private $path;
    
    public function __construct($path)
    {
        $this->path = $path;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $choice_label)
    {
        $builder->setAction($this->getPath());
        
        $builder->add('nom', 'text', array('required' => true));

        $builder->add('modifier_le_fournisseur', 'submit', array('attr' => array('class' => 'buttonUpdate')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\Fournisseur'));
    }
    
    public function getName()
    {
        return 'nomenclatureType';
    }
    
    public function getPath()
    {
        return $this->path;
    }
}