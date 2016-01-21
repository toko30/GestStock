<?php

namespace IC\AdministrationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use IC\AdministrationBundle\Repository\SousFamilleRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddComposantType extends AbstractType
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
                      'query_builder' => function (SousFamilleRepository $er)
                      {
                        return $er->createQueryBuilder('sf')
                        ->where('sf.idFamille = :idFamille')
                        ->setParameter('idFamille', 1);
                      }
                      ));
        
        $builder->add('add_composant', 'submit', array('attr' => array('class' => 'buttonAdd')));
    }
    
    public function configureOptions(OptionsResolver $resolver)
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