<?php

namespace IC\ApprovisionnementBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatierePremiereType extends AbstractType
{
    private $famille;
    private $sousFamille;
    private $fournisseur;

    public function __construct($fam, $sousFam, $four)
    {
        $this->fam = $fam;
        $this->sousFam = $sousFam;
        $this->fournisseur = $four;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach($this->getFam() AS $famille)
            $choixFamille[] = $famille->getNom();
            
        foreach($this->getSousFam() AS $sousFamille)
            $choixSousFamille[] = $sousFamille->getNom();  
            
        foreach($this->getFournisseur() AS $fournisseur)
            $choixFournisseur[] = $fournisseur->getNom(); 
                                        
        $builder->add('famille', 'choice', array('choices' => $choixFamille,
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0));
                    
        $builder->add('sousFamille', 'choice', array('choices' => $choixSousFamille,
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0));                                         
                        
        $builder->add('fournisseur', 'choice', array('choices' => $choixFournisseur,
                        'multiple' => true,
                        'expanded' => true,
                        'empty_data'  => 0)); 
                                        
        $builder->add('Trier', 'submit');
    }

    public function getName()
    {
        return 'formApproMatierePremiere';
    }

    public function getFam()
    {
        return $this->fam;
    }

    public function getSousFam()
    {
        return $this->sousFam;
    }

    public function getFournisseur()
    {
        return $this->fournisseur;
    }

}