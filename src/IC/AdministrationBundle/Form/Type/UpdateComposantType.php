<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use IC\AdministrationBundle\Repository\SousFamilleRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateComposantType extends AbstractType
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
        $builder->add('boitier', 'text', array('required' => true));
        $builder->add('stockMini', 'text', array('required' => true));

        $builder->add('famille', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\Famille',
                      'choice_label' => 'nom',
                      'multiple'  => false,
                      ));
  
        $builder->add('sousFamille', 'entity', array(
                      'class' => 'IC\AdministrationBundle\Entity\SousFamille',
                      'choice_label' => 'nom',

                      'multiple'  => false,
                      'query_builder' => function (SousFamilleRepository $er) use ($builder)
                      {
                        return $er->createQueryBuilder('sf')
                        ->where('sf.idFamille = :idFamille')
                        ->setParameter('idFamille', $builder->getData()->getFamille()->getId());
                      }
                      ));
        
        $builder->add('modifier_le_composant', 'submit');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'IC\AdministrationBundle\Entity\Composant'));
    }
    
    public function getName()
    {
        return 'formComposant';
    }
    
    public function getPath()
    {
        return $this->path;
    }
}