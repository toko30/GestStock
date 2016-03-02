<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use IC\AdministrationBundle\Repository\FournisseurRepository;

class AddComposantFournisseurType extends AbstractType
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
        $builder->add('prix', 'text', array('required' => true));

        $builder->add('fournisseur', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\Fournisseur',
                      'choice_label' => 'nom',
                      'multiple'  => false,
                      'query_builder' => function (FournisseurRepository $er) 
                      {
                        return $er->createQueryBuilder('f')
                        ->where('f.type = 1');
                      }
                      ));

        $builder->add('add_composant_fournisseur', 'submit', array('attr' => array('class' => 'buttonAdd')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\ComposantFournisseur'));
    }
    
    public function getName()
    {
        return 'formAddComposantFournisseurType';
    }
    
    public function getPath()
    {
        return $this->path;
    }   
}
