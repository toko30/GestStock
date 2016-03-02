<?php

namespace IC\ApprovisionnementBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use IC\ApprovisionnementBundle\Repository\FournisseurRepository;

class MatierePremiereType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {          
                                        
        $builder->add('famille', 'entity', array(
                        'class' => 'IC\ApprovisionnementBundle\Entity\Famille',
                        'choice_label' => 'nom',
                        'multiple' => true,
                        'expanded' => true));
                    
        $builder->add('sousFamille', 'entity', array(
                        'class' => 'IC\ApprovisionnementBundle\Entity\SousFamille',
                        'choice_label' => 'nom',
                        'multiple' => true,
                        'expanded' => true));                                         
                        
        $builder->add('fournisseur', 'entity', array(
                      'class' => 'IC\ApprovisionnementBundle\Entity\Fournisseur',
                      'choice_label' => 'nom',
                      'multiple'  => true,
                      'expanded' => true,
                      'query_builder' => function (FournisseurRepository $er) 
                      {
                        return $er->createQueryBuilder('f')
                        ->where('f.type = 1');
                      }
                      ));
                                        
        $builder->add('Trier', 'submit');
    }

    public function getName()
    {
        return 'formApproMatierePremiere';
    }
}