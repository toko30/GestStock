<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddFournisseurType extends AbstractType
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
        $builder->add('contact', 'text', array('required' => false));
        $builder->add('email', 'text', array('required' => false));
        $builder->add('numero', 'text', array('required' => false));
        $builder->add('site', 'text', array('required' => false));
      
        $builder->add('type', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\TypeProduit',
                      'choice_label' => 'nom',
                      'multiple'  => false));

        $builder->add('add_fournisseur', 'submit', array('attr' => array('class' => 'buttonAdd')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\Fournisseur'));
    }
        
    public function getName()
    {
        return 'formAddFournisseurType';
    }
    
    public function getPath()
    {
        return $this->path;
    }
}