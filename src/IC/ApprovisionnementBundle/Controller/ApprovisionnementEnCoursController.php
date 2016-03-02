<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $approLecteur = $this->getDoctrine()->getManager()->getRepository('ICApprovisionnementBundle:ApproLecteur')-> getApproLecteur();
        $approAutre = $this->getDoctrine()->getManager()->getRepository('ICApprovisionnementBundle:ApproAutre')-> getApproAutre();        

        return $this->render('ICApprovisionnementBundle:EnCours:produitsFinisAutre.html.twig', array('partie' => 'approvisionnement', 
                                                                                                     'approLecteur' => $approLecteur,
                                                                                                     'approAutre' => $approAutre));
    }
    
    public function approEnCoursSousTraitantAction($idSousTraitant)
    {
        //Connexion Doctrine
        $em = $this->getDoctrine()->getManager();
        
        //Liste des requètes Doctrine
        $listProdSousTraitant = $em->getRepository('ICApprovisionnementBundle:Production')->getListProdSousTraitantById($idSousTraitant);
        $infoSousTraitant = $em->getRepository('ICApprovisionnementBundle:SousTraitant')->find($idSousTraitant);
        
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
            $i1 = 0;
            
            for($i = 0; $i < count($quantiteNomenclature['idComposant']); $i++)
            {
                $existe = 0;
                foreach ($listComposantSousTraitant as $composantSousTraitant) 
                {
                    if($composantSousTraitant->getIdComposant() == $quantiteNomenclature['idComposant'][$i])
                    {
                        $existe = 1;
                        if($composantSousTraitant->getQuantite() < $quantiteNomenclature['quantite'][$i])
                        {
                            $composant = $em->getRepository('ICApprovisionnementBundle:Composant')->getComposantById($quantiteNomenclature['idComposant'][$i]);
                        
                            $composantAEnvoyer[$i1]['id'] = $composant[0]->getId();
                            $composantAEnvoyer[$i1]['nom'] = $composant[0]->getNom();
                            $composantAEnvoyer[$i1]['boitier'] = $composant[0]->getBoitier();
                            $composantAEnvoyer[$i1]['famille'] = $composant[0]->getFamille()->getNom();
                            $composantAEnvoyer[$i1]['sousFamille'] = $composant[0]->getSousFamille()->getNom();
                            $composantAEnvoyer[$i1]['quantite'] = $quantiteNomenclature['quantite'][$i] - $composantSousTraitant->getQuantite();
                            
                            if($composant[0]->getStockInterne() < $composantAEnvoyer[$i1]['quantite'])
                                $composantAEnvoyer[$i1++]['dispo'] = 0;
                            else
                                $composantAEnvoyer[$i1++]['dispo'] = 1; 
                        }
                    }
                }
                
                if($existe == 0)
                {
                    $composant = $em->getRepository('ICApprovisionnementBundle:Composant')->getComposantById($quantiteNomenclature['idComposant'][$i]);
                    
                    $composantAEnvoyer[$i1]['id'] = $composant[0]->getId();
                    $composantAEnvoyer[$i1]['nom'] = $composant[0]->getNom();
                    $composantAEnvoyer[$i1]['boitier'] = $composant[0]->getBoitier();
                    $composantAEnvoyer[$i1]['famille'] = $composant[0]->getFamille()->getNom();
                    $composantAEnvoyer[$i1]['sousFamille'] = $composant[0]->getSousFamille()->getNom();
                    $composantAEnvoyer[$i1]['quantite'] = $quantiteNomenclature['quantite'][$i];
                    
                    if($composant[0]->getStockInterne() < $composantAEnvoyer[$i1]['quantite'])
                        $composantAEnvoyer[$i1++]['dispo'] = 0;
                    else
                        $composantAEnvoyer[$i1++]['dispo'] = 1;                  
                }
            }            
        }

        return $this->render('ICApprovisionnementBundle:EnCours:sousTraitant.html.twig', array('partie' => 'approvisionnement',
                                                                                               'nomSousTraitant' => $infoSousTraitant->getNom(),
                                                                                               'idSousTraitant' => $idSousTraitant,
                                                                                               'envoiComposantST' => $composantAEnvoyer));
    }
    
    public function approVersStockInterneAction($idCommande)
    {
        $em = $this->getDoctrine()->getManager(); 
        
        $appro = $em->getRepository('ICApprovisionnementBundle:Appro')->findOneBy(array('id' => $idCommande));
        $approComposant = $em->getRepository('ICApprovisionnementBundle:ApproComposant')->getApproComposantById($idCommande);
        
        $em->remove($appro);
        
        $this->container->get('ic_approvisionnement_en_cours')->addStockInterne($approComposant);
        
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
        $this->container->get('ic_approvisionnement_en_cours')->addStockSousTraitant($request, $idSousTraitant);
        
        return $this->redirectToRoute('ic_approvisionnement_mp_production');
    }
}
