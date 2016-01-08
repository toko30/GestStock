<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\ApprovisionnementBundle\Classes\ApprovisionnementProduction;

class ApprovisionnementMPController extends Controller
{
    public function approInterneProductionAction()
    {   
        $em = $this->getDoctrine()->getManager();
        
        //calcul du nombre de composant nécéssaire à la production
        $info = $this->container->get('ic_approvisionnement')->calculApproProd();
        list($quantiteCommande, $composantStockST) = $info;
        
        //ajout du stock actuel du ou des sous traitant au quantité à commander
        if(isset($composantStockST['idComposant'][0]))
            $quantiteCommande = $this->container->get('ic_approvisionnement')->ajoutStockST($composantStockST, $quantiteCommande);
            
        //soustraction des appro en cour au quantité nécéssaires
        $listApproEnCours = $em->getRepository('ICApprovisionnementBundle:ApproComposant')->getApproEnCours();
        
        if($listApproEnCours != null)
            $quantiteCommande = $this->container->get('ic_approvisionnement')->ajoutApproEnCour($listApproEnCours, $quantiteCommande);
        
        //sortie des composants dont le stock est suffisant
        $quantiteCommande = $this->container->get('ic_approvisionnement')->verifStockCommande($quantiteCommande);
        
        //récupération des fournisseurs dont le composant est disponible
        if($quantiteCommande != null)
            $listComposantFournisseur = $em->getRepository('ICApprovisionnementBundle:Moq')->getMoqAndFournisseur($quantiteCommande);
        else
            $listComposantFournisseur = array();
        //var_dump($listComposantFournisseur);
        
        return $this->render('ICApprovisionnementBundle:MP:approMP.html.twig', array('partie' => 'approvisionnement', 
                                                                                        'titrePartie' => 'Approvisionnement nécéssaire à la production',
                                                                                        'textPartie' => 'Aucun approvisionnement nécéssaire à la production
                                                                                                         Si une production ne peut être lancée c\'est que les composants sont en cours d\'approvisionnement',
                                                                                        'composantFournisseur' => $listComposantFournisseur,
                                                                                        'quantiteCommande' => $quantiteCommande));
    }
    
    public function approInterneCritiqueAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        //Calcul des composant dont les stock mini est superieur au stock actuel
        $quantiteCommande = $this->container->get('ic_approvisionnement')->calculApproCritique();
        
        //soustraction des appro en cour au quantité nécéssaires
        $listApproEnCours = $em->getRepository('ICApprovisionnementBundle:ApproComposant')->getApproEnCours();
        
        if($listApproEnCours != null)
            $quantiteCommande = $this->container->get('ic_approvisionnement')->ajoutApproEnCour($listApproEnCours, $quantiteCommande);    
  
       //sortie des composants dont le stock est suffisant
        $quantiteCommande = $this->container->get('ic_approvisionnement')->verifStockCommande($quantiteCommande); 
                     
        //récupération des fournisseurs dont le composant est disponible
        if($quantiteCommande != null)
            $listComposantFournisseur = $em->getRepository('ICApprovisionnementBundle:Moq')->getMoqAndFournisseur($quantiteCommande);
        else
            $listComposantFournisseur = array();          
               
        return $this->render('ICApprovisionnementBundle:MP:approMP.html.twig', array('partie' => 'approvisionnement',
                                                                                        'titrePartie' => 'Approvisionnement des composants en etat critique',
                                                                                        'textPartie' => 'Aucun composant dont le stock est en etat critique',
                                                                                        'composantFournisseur' => $listComposantFournisseur,
                                                                                        'quantiteCommande' => $quantiteCommande));
    }
    
    public function calculApproAction(request $request, $idFournisseur)
    {
        //Ajoute les composant a la liste des appro en cours
        $this->container->get('ic_approvisionnement')->calculAppro($request, $idFournisseur);

        return $this->redirectToRoute('ic_approvisionnement_mp_production');
    }
}
