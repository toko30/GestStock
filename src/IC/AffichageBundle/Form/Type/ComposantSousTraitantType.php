<?php

namespace IC\AffichageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComposantSousTraitantType extends AbstractType
{
  
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('recherche', 'text', array('required' => false));

        $builder->add('choixRecherche', 'choice', array('choices' => array('Désignation', 'Référence'),
                        'multiple' => false,
                        'expanded' => true,
                        'empty_data'  => 0));
                                        
        $builder->add('famille', 'entity', array(
                        'class' => 'IC\AffichageBundle\Entity\Famille',
                        'choice_label' => 'nom',
                        'multiple' => true,
                        'expanded' => true));
                    
        $builder->add('sousFamille', 'entity', array(
                        'class' => 'IC\AffichageBundle\Entity\SousFamille',
                        'choice_label' => 'nom',
                        'multiple' => true,
                        'expanded' => true));            
                                    

        $builder->add('stock', 'text', array('required' => false));

        $builder->add('plus_ou_moins', 'choice', array('choices' => array('Supérieur', 'Inférieur'),
                    'multiple' => false,
                    'expanded' => true,
                    'empty_data'  => 0));    
                    
        $builder->add('Rechercher', 'submit');                                                 
        $builder->add('Trier', 'submit');
    }

    public function getName()
    {
        return 'formComposantSousTraitant';
    }
}