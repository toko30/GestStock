<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateComposantFournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $choice_label)
    {
        
        $builder->add('reference', 'text', array('required' => true));
        $builder->add('prix', 'text', array('required' => true));

        $builder->add('fournisseur', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\Fournisseur',
                      'choice_label' => 'nom',
                      'multiple'  => false
                      ));

        $builder->add('update_composant_fournisseur', 'submit', array('attr' => array('class' => 'buttonUpdate')));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\ComposantFournisseur'));
    }
    
    public function getName()
    {
        return 'formUpdateComposantFournisseurType';
    }
}