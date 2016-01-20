<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use IC\AdministrationBundle\Repository\FournisseurRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
        $builder->add('contact', 'text', array('required' => true));
        $builder->add('numero', 'text', array('required' => true));
        $builder->add('site', 'text', array('required' => true));
        $builder->add('email', 'text', array('required' => true));
        
        $builder->add('type', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\TypeProduit',
                      'choice_label' => 'nom',
                      'multiple'  => false,
                      ));

        $builder->add('modifier_le_fournisseur', 'submit', array('attr' => array('class' => 'buttonUpdate')));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\Fournisseur'));
    }
    
    public function getName()
    {
        return 'formUpdateFournisseurType';
    }
    
    public function getPath()
    {
        return $this->path;
    }
}