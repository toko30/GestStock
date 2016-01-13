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
        $appro = $this->getDoctrine()->getManager()->getRepository('ICApprovisionnementBundle:ApproIdentifiant')->getApproIdentifiant();
        
        return $this->render('ICApprovisionnementBundle:EnCours:produitsFinisIdentifiant.html.twig', array('partie' => 'approvisionnement', 
                                                                                                           'appro' => $appro));
    }
    
    public function approEnCoursPFAutreAction()
    {
        $approLecteur = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproLecteur')-> getApproLecteur();
        $approAutre = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ApproAutre')-> getApproAutre();        

        return $this->render('ICApprovisionnementBundle:EnCours:produitsFinisAutre.html.twig', array('partie' => 'approvisionnement', 
                                                                                                     'approLecteur' => $approLecteur,
                                                                                                     'approAutre' => $approAutre));
    }
    
    public function approEnCoursSousTraitantAction()
    {
        return $this->render('ICApprovisionnementBundle:EnCours:sousTraitant.html.twig', array('partie' => 'approvisionnement', 'name' => 'test'));
    }
    
    public function approVersStockInterneAction($idCommande)
    {
        $em = $this->getDoctrine()->getManager(); 
        
        $appro = $em->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $idCommande));
        $approComposant = $em->getRepository('ICApprovisionnementBundle:ApproComposant')->getApproComposantById($idCommande);
        
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
    
    public function approVersStockIdentifiantAction($idCommande)
    {
        $em = $this->getDoctrine()->getManager(); 
        
        $appro = $em->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $idCommande));
        $approIdentifiant = $em->getRepository('ICApprovisionnementBundle:ApproIdentifiant')->getApproIdentifiantById($idCommande); 
        
        $em->remove($appro);
                           
        foreach($approIdentifiant as $aId)
        {
            $newQuantite = $aId->getBadge()->setQuantite($aId->getQuantite() + $aId->getBadge()->getQuantite());
            
            $em->persist($newQuantite);
            $em->remove($aId);
        }
        
        $em->flush();
        
        return $this->redirectToRoute('ic_approvisionnement_en_cours_identifiant');
    }
    public function approVersStockLecteurAction($idCommande)
    {
        
    }
    
    public function approVersStockAutreAction($idCommande)
    {
        $em = $this->getDoctrine()->getManager(); 
        
        $appro = $em->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $idCommande));
        $approAutre = $em->getRepository('ICApprovisionnementBundle:ApproAutre')->getApproAutreById($idCommande);
        
        var_dump($approAutre);        
        $em->remove($appro);
                           
        foreach($approAutre as $aAutre)
        {
            $newQuantite = $aAutre->getAutre()->setQuantite($aAutre->getQuantite() + $aAutre->getAutre()->getQuantite());
            
            $em->persist($newQuantite);
            $em->remove($aAutre);
        }
        
        $em->flush();
        
        return $this->redirectToRoute('ic_approvisionnement_en_cours_autre');
    }
}
