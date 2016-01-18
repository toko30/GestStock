<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\ApprovisionnementBundle\Entity\ComposantSousTraitant;

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
    
    public function approEnCoursSousTraitantAction($idSousTraitant)
    {
        //Connexion Doctrine
        $em = $this->getDoctrine()->getManager();
        
        //Liste des requètes Doctrine pour les options du menu
        $listProdSousTraitant = $em->getRepository('ICApprovisionnementBundle:Production')->getListProdSousTraitantById($idSousTraitant);
        
        $i = 0;

        foreach($listProdSousTraitant as $prodSousTraitant)
        {
            $listComposantNomenclature = $em->getRepository('ICApprovisionnementBundle:ComposantNomenclature')->getComposantNomenclature($prodSousTraitant->getIdNomenclature());        
            
            $listComposantUtilise = explode(',', $prodSousTraitant->getComposantUtilise());
            
            foreach($listComposantNomenclature as $composantNomenclature)
            {
                if(in_array($composantNomenclature->getIdComposant(), $listComposantUtilise))
                {
                    if(empty($quantiteNomenclature))
                    {
                        $quantiteNomenclature['idComposant'][] = $composantNomenclature->getIdComposant();
                        $quantiteNomenclature['quantite'][] = $composantNomenclature->getQuantite() * $prodSousTraitant->getQuantite();                        
                    }
                    else
                    {
                        $existe = 0;
                        
                        for($i1 = 0; $i1 < count($quantiteNomenclature['idComposant']); $i1++)
                        {
                            if($quantiteNomenclature['idComposant'][$i1] == $composantNomenclature->getIdComposant())
                            {
                                $existe = 1;
                                $quantiteNomenclature['quantite'][$i1] += $composantNomenclature->getQuantite() * $prodSousTraitant->getQuantite();
                            }
                        }
                        
                        if($existe == 0)
                        {
                            $quantiteNomenclature['idComposant'][] = $composantNomenclature->getIdComposant();
                            $quantiteNomenclature['quantite'][] = $composantNomenclature->getQuantite() * $prodSousTraitant->getQuantite();   
                        }
                    }
                }            
            } 
        }

        $listComposantSousTraitant = $em->getRepository('ICApprovisionnementBundle:ComposantSousTraitant')->getComposantSt($idSousTraitant);

        if(empty($listComposantSousTraitant))
        {
            for($i = 0; $i < count($quantiteNomenclature['idComposant']); $i++)
            {
                $composant = $em->getRepository('ICApprovisionnementBundle:Composant')->getComposantById($quantiteNomenclature['idComposant'][$i]);
                
                $composantAEnvoyer[$i]['id'] = $composant[0]->getId();
                $composantAEnvoyer[$i]['nom'] = $composant[0]->getNom();
                $composantAEnvoyer[$i]['boitier'] = $composant[0]->getBoitier();
                $composantAEnvoyer[$i]['famille'] = $composant[0]->getFamille()->getNom();
                $composantAEnvoyer[$i]['sousFamille'] = $composant[0]->getSousFamille()->getNom();
                $composantAEnvoyer[$i]['quantite'] = $quantiteNomenclature['quantite'][$i];

                if($composant[0]->getStockInterne() < $composantAEnvoyer[$i]['quantite'])
                    $composantAEnvoyer[$i]['dispo'] = 0;
                else
                    $composantAEnvoyer[$i]['dispo'] = 1;
            }
        }
        else
        {
            for($i = 0; $i < count($quantiteNomenclature['idComposant']); $i++)
            {
                foreach ($listComposantSousTraitant as $composantSousTraitant) 
                {
                    if($composantSousTraitant->getIdComposant() == $quantiteNomenclature['idComposant'][$i] && $composantSousTraitant->getQuantite() < $quantiteNomenclature['quantite'][$i])
                    {  
                        $composant = $em->getRepository('ICApprovisionnementBundle:Composant')->getComposantById($quantiteNomenclature['idComposant'][$i]);
                        
                        $composantAEnvoyer[$i]['id'] = $composant[0]->getId();
                        $composantAEnvoyer[$i]['nom'] = $composant[0]->getNom();
                        $composantAEnvoyer[$i]['boitier'] = $composant[0]->getBoitier();
                        $composantAEnvoyer[$i]['famille'] = $composant[0]->getFamille()->getNom();
                        $composantAEnvoyer[$i]['sousFamille'] = $composant[0]->getSousFamille()->getNom();
                        $composantAEnvoyer[$i]['quantite'] = $quantiteNomenclature['quantite'][$i] - $composantSousTraitant->getQuantite();
                        
                        if($composant[0]->getStockInterne() < $composantAEnvoyer[$i]['quantite'])
                            $composantAEnvoyer[$i]['dispo'] = 0;
                        else
                            $composantAEnvoyer[$i]['dispo'] = 1;
                    }
                }
            }            
        }
 
        return $this->render('ICApprovisionnementBundle:EnCours:sousTraitant.html.twig', array('partie' => 'approvisionnement', 
                                                                                               'idSousTraitant' => $idSousTraitant,
                                                                                               'envoiComposantST' => $composantAEnvoyer));
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
    
    public function approVersStockSousTraitantAction(request $request, $idSousTraitant)
    {
        $em = $this->getDoctrine()->getManager(); 
        
        foreach ($request->get('option') as $idComposant) 
        {
            $composantST = $em->getRepository('ICApprovisionnementBundle:ComposantSousTraitant')->getComposantBySousTraitant($idComposant, $idSousTraitant);
            $composant = $em->getRepository('ICApprovisionnementBundle:Composant')->findOneBy(array('id' => $idComposant));
            $sousTraitant = $em->getRepository('ICApprovisionnementBundle:SousTraitant')->findOneBy(array('id' => $idSousTraitant));

            if(!empty($composantST))
            {
                $composantST[0]->setQuantite($composantST[0]->getQuantite() + $request->get($idComposant));
                
                $em->persist($composantST[0]);
            }
            else
            {               
                $newComposantST = new ComposantSousTraitant();
                $newComposantST->setSousTraitant($sousTraitant);
                $newComposantST->setComposant($composant);
                $newComposantST->setQuantite($request->get($idComposant));
                
                $em->persist($newComposantST);
            }
        }
        
        $em->flush();
        
        return $this->redirectToRoute('ic_approvisionnement_mp_production');
    }
}
