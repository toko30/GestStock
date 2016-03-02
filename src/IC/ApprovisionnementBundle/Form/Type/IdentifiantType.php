<?php

namespace IC\ApprovisionnementBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class IdentifiantType extends AbstractType
{
    private $type;

    public function __construct($typ)
    {
        $this->type = $typ;
        
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        foreach($this->getType() AS $type)
            $choixType[] = $type->getNom();            

        $builder->add('frequence', 'choice', array('choices' => array('125KHz', '13,56MHz'),
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0));
                    
        $builder->add('type', 'choice', array('choices' => $choixType,
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0));
                                        
        $builder->add('Trier', 'submit');
    }

    public function getName()
    {
        return 'formApproIdentifiant';
    }
    
    public function getType()
    {
        return $this->type;
    }
}