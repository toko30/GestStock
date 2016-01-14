<?php

namespace IC\ApprovisionnementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MenuController extends Controller
{
    public function menuAction($url)
    {
        //Connexion Doctrine
        $em = $this->getDoctrine()->getManager();
        
        //Liste des requètes Doctrine pour les options du menu
        $listProdSousTraitant = $em->getRepository('ICApprovisionnementBundle:Production')->getListProdSousTraitant();
        $i = 0;
        
        foreach($listProdSousTraitant as $prodSousTraitant)
        {
            $listComposantNomenclature = $em->getRepository('ICApprovisionnementBundle:ComposantNomenclature')->getComposantNomenclature($prodSousTraitant->getIdNomenclature());
            $listComposantSousTraitant = $em->getRepository('ICApprovisionnementBundle:ComposantSousTraitant')->getComposantSt($prodSousTraitant->getIdLieu());
            
            $listComposantUtilise = explode(',', $prodSousTraitant->getComposantUtilise());
            
            
            //Si le sous traitant change on nettoie la liste des composant
            if(!isset($idLieuPrecedent) || $prodSousTraitant->getIdLieu() != $idLieuPrecedent)
            {
                unset($quantiteNomenclature);
            }
            
            $idLieuPrecedent = $prodSousTraitant->getIdLieu();
            
            //Si aucun composant n'est chez le sous traitant on lajoute a la liste
            if(empty($listComposantSousTraitant))
            {
                $sousTraitant = $em->getRepository('ICApprovisionnementBundle:SousTraitant')->findOneBy(array('id' => $prodSousTraitant->getIdLieu()));
                
                if(empty($ListSousTraitant))
                {
                    $ListSousTraitant[$i]['id'] = $sousTraitant->getId();
                    $ListSousTraitant[$i++]['nom'] = $sousTraitant->getNom();
                }
                else
                {
                    $existe = 0;
                    //on vérifie que le sous traitant n'est pas déja dans la liste
                    for($i1 = 0; $i1 < count($ListSousTraitant); $i1++)
                    {
                        if($sousTraitant->getId() == $ListSousTraitant[$i1]['id'])
                            $existe = 1;
                    }
                    //si il n'y est pas on l'ajoute
                    if($existe == 0)
                    {
                       $ListSousTraitant[$i]['id'] = $sousTraitant->getId();
                       $ListSousTraitant[$i++]['nom'] = $sousTraitant->getNom();                        
                    }
                }
            }
            else
            {
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
                
                foreach ($listComposantSousTraitant as $ComposantST) 
                {                            
                    for($i1 = 0; $i1 < count($quantiteNomenclature['idComposant']); $i1++)
                    {
                        //echo $quantiteNomenclature['idComposant'][$i1].'=='.$ComposantST->getIdComposant().' '.$quantiteNomenclature['quantite'][$i1].'>'.$ComposantST->getQuantite().'<br>';
                        if($quantiteNomenclature['idComposant'][$i1] == $ComposantST->getIdComposant() && $quantiteNomenclature['quantite'][$i1] > $ComposantST->getQuantite())
                        {
                            
                            if(empty($ListSousTraitant))
                            {
                                $ListSousTraitant[$i]['id'] = $ComposantST->getSousTraitant()->getId();
                                $ListSousTraitant[$i++]['nom'] = $ComposantST->getSousTraitant()->getNom();
                            }
                            else
                            {
                                $existe = 0;
                                //on vérifie que le sous traitant n'est pas déja dans la liste
                                for($i1 = 0; $i1 < count($ListSousTraitant); $i1++)
                                {
                                    if($ComposantST->getSousTraitant()->getId() == $ListSousTraitant[$i1]['id'])
                                        $existe = 1;
                                }
                                //si il n'y est pas on l'ajoute
                                if($existe == 0)
                                {
                                $ListSousTraitant[$i]['id'] = $ComposantST->getSousTraitant()->getId();
                                $ListSousTraitant[$i++]['nom'] = $ComposantST->getSousTraitant()->getNom();                        
                                }
                            }
                        }
                    }
                }                                       
            }           
        }

        //Création des formulaires en fonction de la page
        
        //génération du template Twig
        return $this->render('ICApprovisionnementBundle:MenuVertical:menu.html.twig', array('url' => $url,
                                                                                            'sousTraitants' => $ListSousTraitant));
    }
}
