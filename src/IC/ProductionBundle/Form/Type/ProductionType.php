<?php

namespace IC\ProductionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductionType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $choice_label)
  {
      
    $builder->add('quantite', 'text', array('required' => false));
    $builder->add('nomenclature', 'entity', array(
                    'class' => 'IC\ProductionBundle\Entity\Nomenclature',
                    'choice_label' => 'nom',
                    'multiple'  => false
                    ));

    $builder->add('calculer', 'submit');
  }

  public function getName()
  {
    return 'formProduction';
  }
}