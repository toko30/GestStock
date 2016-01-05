<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use IC\ApprovisionnementBundle\Classes\ApprovisionnementProduction;

class ApprovisionnementMPController extends Controller
{
    public function approInterneProductionAction()
    {   
        $em = $this->getDoctrine()->getManager(); 
        $info = $this->container->get('ic_approvisionnement.calculcomposantprod')->calculApproProd();
        
        list($quantiteCommande, $composantStockST) = $info;
        
        //ajout du stock acutel du ou des sous traitant au quantité à commander
        if(isset($composantStockST['idComposant'][0]))
        {
            $quantiteCommande = $this->container->get('ic_approvisionnement.calculcomposantprod')->ajoutStockST($composantStockST, $quantiteCommande);
        }
        $listApproEnCours = $em->getRepository('ICApprovisionnementBundle:Moq')->getApproEnCours();
        //sortie des composants dont le stock est suffisant
        $quantiteCommande = $this->container->get('ic_approvisionnement.calculcomposantprod')->verifStockCommande($quantiteCommande);
        
        $listComposantFournisseur = $em->getRepository('ICApprovisionnementBundle:Moq')->getMoqAndFournisseur($quantiteCommande['idComposant']);
        
        //var_dump($listComposantFournisseur);
        
        return $this->render('ICApprovisionnementBundle:MP:production.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approInterneCritiqueAction()
    {
        return $this->render('ICApprovisionnementBundle:MP:critique.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
}
