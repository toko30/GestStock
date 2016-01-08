<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApprovisionnementEnCoursController extends Controller
{
    public function approEnCoursMPAction()
    {
        $appro = $this->getDoctrine()->getManager()->getRepository('ICApprovisionnementBundle:ApproComposant')->getAllApproEnCours();
        
        return $this->render('ICApprovisionnementBundle:EnCours:matierePremiere.html.twig', array('partie' => 'approvisionnement', 
                                                                                                  'appro' => $appro));
    }
    
    public function approEnCoursPFIdentifiantAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:produitsFinisIdentifiant.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approEnCoursPFAutreAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:produitsFinisAutre.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approEnCoursSousTraitantAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:sousTraitant.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approVersStockAction($idCommande)
    {
        $em = $this->getDoctrine()->getManager(); 
        
        $appro = $em->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $idCommande));
        $approComposant = $em->getRepository('ICApprovisionnementBundle:ApproComposant')->getApproById($idCommande);
        
        $em->remove($appro);
         
        foreach($approComposant as $aComp)
        {
            $newQuantite = $aComp->getComposant()->setStockInterne($aComp->getComposant()->getStockInterne() + $aComp->getQuantite());
            
            $em->persist($newQuantite);
            $em->remove($aComp);
        }
        $em->flush();
        
        return $this->redirectToRoute('ic_approvisionnement_en_cours_mp');
    }
}
