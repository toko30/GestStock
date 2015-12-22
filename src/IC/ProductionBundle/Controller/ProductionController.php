<?php
namespace IC\ProductionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\ProductionBundle\Form\Type\ProductionType;
use IC\ProductionBundle\Entity\Production;

class ProductionController extends Controller
{
    public function interneAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager(); 
              
        if('POST' == $request->getMethod())
        {    
            //Récupération de la derniere version de la nomenclature
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->getVersion($_POST['formProduction']['nomenclature']);
            $idVersion = $version[0]->getId();
            $version = $version[0]->getVersion();
            
            //enregistrement du nom de la nomenclature et les composants qui y sont liés            
            $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($idVersion);
            $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();
                   
            //déclaration à 0 du nombre de carte qui ne pourront pas être produites
            $nbProdManquant = 0;
            $i = 0;
            
            //Calcul des cartes pouvant etre produites
            foreach($listeComposantnomenclature as $composant)
            {
                $calculStockRestant = $composant->getComposant()->getStockInterne() - ($composant->getQuantite() * $_POST['formProduction']['quantite']);

                $tabComposant[$i]['designation'] = $composant->getComposant()->getNom();
                $tabComposant[$i]['quantite'] = $composant->getQuantite() * $_POST['formProduction']['quantite'];             
                $tabComposant[$i++]['stock'] = $calculStockRestant;
                
                //Mise a jour du nombre de carte qui ne pourront pas etre produite avec le stock actuel
                if($calculStockRestant < 0)
                {
                    $calculQuantite = round(abs($calculStockRestant) / $composant->getQuantite(), 0, PHP_ROUND_HALF_DOWN);
                    
                    if(isset($nbProdManquant))
                    {
                        if($nbProdManquant < $calculQuantite)
                            $nbProdManquant = $calculQuantite;
                    }
                    else
                        $nbProdManquant = $calculQuantite;
                }
            }
            //génération de la vue avec les info de la carte et ses composants calculés précédement
            return $this->render('ICProductionBundle:Liste:interne.html.twig', array('quantite' => $_POST['formProduction']['quantite'], 
                                                                                     'composantNomenclature' => $tabComposant,
                                                                                     'nomenclature' => $nomenclature,
                                                                                     'idVersion' => $idVersion,
                                                                                     'version' => $version,
                                                                                     'nbProdManquant' => $nbProdManquant));            
        }
        //AFFICHAGE DES TABLEAUX PREVISIONNEL ET EN PROD EN COURS
        else
        {
            $listeProd = $em->getRepository('ICProductionBundle:Production')->getProdInterne(0);
            
            //déclaration des variable vide au cas ou il n'y est pas de prod de lancée
            $listeEnCours = '';
            $listePrevisionnelle = '';
            
            $i = 0;
            $i1 = 0;
            
            foreach($listeProd as $prod)
            {
                //enregistrement des productions en cours
                if($prod->getEtape() == 2)
                {
                    $listeEnCours[$i]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                    $listeEnCours[$i]['quantite'] = $prod->getQuantite();
                    $listeEnCours[$i++]['date_prod'] = $prod->getDateProd();
                }
                else
                {
                    //enregistrement des prod prévisionelle
                    $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($prod->getVersion()->getId());
                    
                    $listePrevisionnelle[$i1]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                    $listePrevisionnelle[$i1]['quantite'] = $prod->getQuantite();
                    $listePrevisionnelle[$i1]['lancement'] = 1;
                    
                    //vérification de la possibilité de lancement d'une production
                    foreach($listeComposantnomenclature as $composantNomenclature)
                    {
                        if($composantNomenclature->getComposant()->getStockInterne() - ($prod->getQuantite() * $composantNomenclature->getQuantite()) < 0)
                        {
                            $listePrevisionnelle[$i1]['lancement'] = 0; 
                            break;
                        }     
                    }
                    $i1++;
                }
            }
            //Création du formulaire et affichage de la vue
            $form = $this->createForm(new ProductionType());
            return $this->render('ICProductionBundle:Production:interne.html.twig', array('form' => $form->createView(),
                                                                                          'listeEnCours' => $listeEnCours,
                                                                                          'listePrevisionnelle' => $listePrevisionnelle));
        }
    }
    
    public function sousTraitantAction(Request $request, $id)
    {   
        $em = $this->getDoctrine()->getManager();
        
        //AFFICHAGE LISTE COMPOSANT NOMENCLATURE
        if('POST' == $request->getMethod())
        {         
            //Récupération de la derniere version de la nomenclature
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->getVersion($_POST['formProduction']['nomenclature']);   
            $idVersion = $version[0]->getId();
            $version = $version[0]->getVersion();
            
            //enregistrement du sous traitant, du nom de la nomenclature et les composants qui y sont liés
            $ComposantSousTraitant = $em->getRepository('ICProductionBundle:ComposantSousTraitant')->getComposantSt($id);
            $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($idVersion);  
            $nomSousTraitant = $ComposantSousTraitant[0]->getSousTraitant()->getNom();
            $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();
                        
            //déclaration à 0 du nombre de carte qui ne pourront pas etre produites
            $nbProdManquant = 0;

            $i = 0;
            //Calcul des cartes pouvant etre produites          
            foreach ($listeComposantnomenclature as $composant)
            {
                $calculStockRestant = 0 - ($composant->getQuantite() * $_POST['formProduction']['quantite']);
                
                //Vérification de la présence des composant dans le stock sous Traitant
                foreach($ComposantSousTraitant as $st)
                {
                    if($st->getIdComposant() == $composant->getComposant()->getId())
                        $calculStockRestant = $st->getQuantite() - ($composant->getQuantite() * $_POST['formProduction']['quantite']);
                }
                    
                $tabComposant[$i]['id'] = $composant->getComposant()->getId();
                $tabComposant[$i]['designation'] = $composant->getComposant()->getNom();
                $tabComposant[$i]['quantite'] = $composant->getQuantite() * $_POST['formProduction']['quantite'];           
                $tabComposant[$i]['stock'] = $calculStockRestant;
                $tabComposant[$i++]['option'] = $composant->getOptionSt();
                
                //Mise a jour du nombre de carte qui ne pourront pas etre produite avec le stock actuel
                if($calculStockRestant < 0)
                {
                    $calculQuantite = round(abs($calculStockRestant) / $composant->getQuantite(), 0, PHP_ROUND_HALF_DOWN);
                    
                    if(isset($nbProdManquant))
                    {
                        if($nbProdManquant < $calculQuantite)
                            $nbProdManquant = $calculQuantite;
                    }
                    else
                        $nbProdManquant = $calculQuantite;
                }
            }

            return $this->render('ICProductionBundle:Liste:sousTraitant.html.twig', array('id' => $id,
                                                                                          'quantite' => $_POST['formProduction']['quantite'],
                                                                                          'composantNomenclature' => $tabComposant,
                                                                                          'sousTraitant' => $nomSousTraitant,
                                                                                          'nomenclature' => $nomenclature,
                                                                                          'idVersion' => $idVersion,
                                                                                          'version' => $version,
                                                                                          'nbProdManquant' => $nbProdManquant));            
        }
        //AFFICHAGE DES TABLEAUX PREVISIONNEL ET EN PROD EN COURS
        else
        {
            $listeProd = $em->getRepository('ICProductionBundle:Production')->getProdInterne($id);
            
            //déclaration des variable vide au cas ou il n'y est pas de prod de lancée
            
            $listeEnCours = '';
            $listePrevisionnelle = '';
            
            $i = 0;
            $i1 = 0;
            
            foreach($listeProd as $prod)
            {
                //enregistrement des productions en cours
                if($prod->getEtape() == 2)
                {
                    $listeEnCours[$i]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                    $listeEnCours[$i]['quantite'] = $prod->getQuantite();
                    $listeEnCours[$i++]['date_prod'] = $prod->getDateProd();
                }
                else
                {
                    //récupération des composant utiliser pour la prod St
                    $listeComposantUtiliseSt = explode(',', $prod->getComposantUtilise());
                    
                    //enregistrement des prod prévisionelle
                    $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($prod->getVersion()->getId());
                    $listeComposantSousTraitant = $em->getRepository('ICProductionBundle:ComposantSousTraitant')->getComposantSt($id);
                    
                    $listePrevisionnelle[$i1]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                    $listePrevisionnelle[$i1]['quantite'] = $prod->getQuantite();
                    $listePrevisionnelle[$i1]['lancement'] = 1;
                    
                    //vérification de la possibilité de lancement d'une production
                    foreach($listeComposantnomenclature as $composantNomenclature)
                    {
                        if(in_array($composantNomenclature->getComposant()->getId(), $listeComposantUtiliseSt))
                        { 
                            foreach($listeComposantSousTraitant as $composantSt)
                            {
                                $composantManquant = 1;
                                
                                if($composantNomenclature->getComposant()->getId() == $composantSt->getIdComposant())
                                {
                                    $composantManquant = 0;
                                    if($composantSt->getComposant()->getStockInterne() - ($prod->getQuantite() * $composantNomenclature->getQuantite()) < 0)
                                    {
                                        $listePrevisionnelle[$i1]['lancement'] = 0; 
                                        break;
                                    }
                                    break; 
                                }
                            }
                            //Si le composant n'est pas trouver dans la boucle c'est qu'il n'est pas chez le sousTraitant(on ne peut donc pas produire)
                            if($composantManquant == 1)
                            {
                                $listePrevisionnelle[$i1]['lancement'] = 0; 
                                break;
                            }
                        }
                    }
                    $i1++;
                }
            }
            
            //création du formulaire et affichage de la vue
            $form = $this->createForm(new ProductionType());  
            return $this->render('ICProductionBundle:Production:sousTraitant.html.twig', array('form' => $form->createView(),
                                                                                               'listeEnCours' => $listeEnCours,
                                                                                               'listePrevisionnelle' => $listePrevisionnelle));
        }
    }
    
    public function calculAction(request $request, $idProducteur, $idVersion, $quantite1, $quantite2)
    {
        if($quantite1 != 0)
        {
            //Connexion doctrine
            $em = $this->getDoctrine()->getManager();
            
            //récupération des entitées pour les Jointures 
            $lieu = $em->getRepository('ICProductionBundle:SousTraitant')->findOneBy(array('id' => $idProducteur));
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->findOneBy(array('id' => $idVersion));
            
            $prod = new Production();
            
            //déclaration des jointures (mise a jour auto de idLieu et idNomenclature)
            $prod->setSousTraitant($lieu);
            $prod->setVersion($version);
            
            $prod->setQuantite($quantite1 - $quantite2);
            $prod->setEtape(1);
            $prod->setDateProd(new \Datetime());
            
            if(isset($_POST['option']))
            {
                $listeComposant = '';
                
                foreach ($_POST['option'] as $value)
                    $listeComposant .= $value.',';
                
                $listeComposant = trim($listeComposant, ',');
                
                $prod->setComposantUtilise($listeComposant);
            }
            
            $em->persist($prod);
            
            if($quantite2 != 0)
            {
                $prod1 = new Production();
                
                //déclaration des jointures (mise a jour auto de idLieu et idNomenclature)
                $prod1->setSousTraitant($lieu);
                $prod1->setVersion($version);
                
                $prod1->setQuantite($quantite2);
                $prod1->setEtape(1);
                $prod1->setDateProd(new \Datetime());
                
                $em->persist($prod1);
            }
            
            $em->flush();            
        }       
        
        if($idProducteur == 0)
            return $this->redirectToRoute('ic_production_interne');
        else
            return $this->redirectToRoute('ic_production_sous_traitant', array('id' => $idProducteur));
    }
}
