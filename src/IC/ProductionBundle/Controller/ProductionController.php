<?php
namespace IC\ProductionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\ProductionBundle\Form\Type\ProductionType;
use IC\ProductionBundle\Entity\Production;
use IC\ProductionBundle\Entity\Lot;
use IC\ProductionBundle\Entity\CarteTest;

class ProductionController extends Controller
{
    public function interneAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager(); 
        $data = $request->get('formProduction');

        if('POST' == $request->getMethod() && isset($data['versionNomenclature']))
        {
            
            //Récupération de la derniere version de la nomenclature
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->getVersion($data['versionNomenclature']);
            $idVersion = $version[0]->getId();
            $version = $version[0]->getVersion();
            
            //enregistrement du nom de la nomenclature et les composants qui y sont liés            
            $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($idVersion);
            
            //déclaration à 0 du nombre de carte qui ne pourront pas être produites
            $tabComposant = array();
            $nbProdManquant = 0;
            $i = 0;
            $nomenclature = '';
            if(!empty($listeComposantnomenclature))
            {
                $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();
                
                //Calcul des cartes pouvant etre produites
                foreach($listeComposantnomenclature as $composant)
                {
                    $calculStockRestant = $composant->getComposant()->getStockInterne() - ($composant->getQuantite() * $data['quantite']);

                    $tabComposant[$i]['designation'] = $composant->getComposant()->getNom();
                    $tabComposant[$i]['quantite'] = $composant->getQuantite() * $data['quantite'];             
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
            }            
            
            //génération de la vue avec les info de la carte et ses composants calculés précédement
            return $this->render('ICProductionBundle:Liste:interne.html.twig', array('partie' => 'production',
                                                                                     'quantite' => $data['quantite'], 
                                                                                     'composantNomenclature' => $tabComposant,
                                                                                     'nomenclature' => $nomenclature,
                                                                                     'idVersion' => $idVersion,
                                                                                     'version' => $version,
                                                                                     'nbProdManquant' => $nbProdManquant));            
        }
        //AFFICHAGE DES TABLEAUX PREVISIONNEL ET PROD EN COURS
        else
        {
            //récupération des productions Internes
            $listeProd = $em->getRepository('ICProductionBundle:Production')->getProdInterne(0);
            
            //déclaration des variable vide au cas ou il n'y est pas de prod de lancée
            $listeEnCours = '';
            $listePrevisionnelle = '';
            
            $i = 0;
            $i1 = 0;
            
            foreach($listeProd as $prod)
            {
                //enregistrement des productions en cours pour affichage
                if($prod->getEtape() == 2)
                {
                    $listeEnCours[$i]['id'] = $prod->getId();
                    $listeEnCours[$i]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                    $listeEnCours[$i]['quantite'] = $prod->getQuantite();
                    $listeEnCours[$i++]['date_prod'] = $prod->getDateProd();
                }
                else
                {
                    //enregistrement des prod prévisionelle pour affichage                                      
                    $listePrevisionnelle[$i1]['id'] = $prod->getId();
                    $listePrevisionnelle[$i1]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                    $listePrevisionnelle[$i1]['quantite'] = $prod->getQuantite();
                    $listePrevisionnelle[$i1]['lancement'] = 1;
                    
                    //vérification de la possibilitée de lancement d'une production
                    $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($prod->getVersion()->getId());
                    
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
            
            //Listage des dernières nomenclatures
            $listeAllVersionNomenclature = $em->getRepository('ICProductionBundle:VersionNomenclature')->getAllVersion();
            $i = 0;
            foreach($listeAllVersionNomenclature as $versionNomenclature)
            {
                if($i != $versionNomenclature->getNomenclature()->getId())
                {
                    $i = $versionNomenclature->getNomenclature()->getId();
                    $listLastNomenclature[] = $versionNomenclature;
                }
            }

            //Création du formulaire et affichage de la vue
            $form = $this->createForm(new ProductionType($listLastNomenclature));
            return $this->render('ICProductionBundle:Production:interne.html.twig', array('partie' => 'production',
                                                                                          'form' => $form->createView(),
                                                                                          'listeEnCours' => $listeEnCours,
                                                                                          'listePrevisionnelle' => $listePrevisionnelle));
        }
    }
    
    public function sousTraitantAction(Request $request, $id)
    {   
        $em = $this->getDoctrine()->getManager();
        $data = $request->get('formProduction');
        
        //AFFICHAGE LISTE COMPOSANT NOMENCLATURE
        if('POST' == $request->getMethod())
        {         
            //Récupération de la derniere version de la nomenclature
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->getVersion($data['versionNomenclature']);   
            $idVersion = $version[0]->getId();
            $version = $version[0]->getVersion();
            
            //enregistrement du sous traitant, du nom de la nomenclature et les composants qui y sont liés
            $ComposantSousTraitant = $em->getRepository('ICProductionBundle:ComposantSousTraitant')->getComposantSt($id);
            $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($idVersion);  
            
            if(!empty($ComposantSousTraitant[0]))
                $nomSousTraitant = $ComposantSousTraitant[0]->getSousTraitant()->getNom();
                
            //déclaration à 0 du nombre de carte qui ne pourront pas être produites    
            $tabComposant = array();
            $nbProdManquant = 0;
            $i = 0;
            $nomenclature = '';   
             
            if(!empty($listeComposantnomenclature))
            {
                $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();                           

                //Calcul des cartes pouvant etre produites          
                foreach ($listeComposantnomenclature as $composant)
                {
                    $calculStockRestant = 0 - ($composant->getQuantite() * $data['quantite']);
                    
                    //Vérification de la présence des composant dans le stock sous Traitant
                    foreach($ComposantSousTraitant as $st)
                    {
                        if($st->getIdComposant() == $composant->getComposant()->getId())
                            $calculStockRestant = $st->getQuantite() - ($composant->getQuantite() * $data['quantite']);
                    }
                        
                    $tabComposant[$i]['id'] = $composant->getComposant()->getId();
                    $tabComposant[$i]['designation'] = $composant->getComposant()->getNom();
                    $tabComposant[$i]['quantite'] = $composant->getQuantite() * $data['quantite'];           
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
            } 
            return $this->render('ICProductionBundle:Liste:sousTraitant.html.twig', array('partie' => 'production',
                                                                                          'id' => $id,
                                                                                          'quantite' => $_POST['formProduction']['quantite'],
                                                                                          'composantNomenclature' => $tabComposant,       
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
                    $listeEnCours[$i]['id'] = $prod->getId();
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
                    
                    $listePrevisionnelle[$i1]['id'] = $prod->getId();
                    $listePrevisionnelle[$i1]['nom'] = $prod->getVersion()->getNomenclature()->getNom().'-V'.$prod->getVersion()->getVersion();
                    $listePrevisionnelle[$i1]['quantite'] = $prod->getQuantite();
                    $listePrevisionnelle[$i1]['lancement'] = 1;        
                    
                    //vérification de la possibilité de lancement d'une production
                    foreach($listeComposantnomenclature as $composantNomenclature)
                    {
                        if(in_array($composantNomenclature->getComposant()->getId(), $listeComposantUtiliseSt))
                        {
                            if(empty($listeComposantSousTraitant))
                            {
                                $composantManquant = 1;
                            }
                            else
                            {
                                foreach($listeComposantSousTraitant as $composantSt)
                                {
                                    $composantManquant = 1;
                                    
                                    if($composantNomenclature->getComposant()->getId() == $composantSt->getIdComposant())
                                    {                          
                                        $composantManquant = 0;
                                        if($composantSt->getQuantite() - ($prod->getQuantite() * $composantNomenclature->getQuantite()) < 0)
                                        {
                                            $listePrevisionnelle[$i1]['lancement'] = 0; 
                                            break;
                                        }
                                        break; 
                                    }
                                }                                
                            }

                            //Si le composant n'est pas trouvé dans la boucle c'est qu'il n'est pas chez le sousTraitant(on ne peut donc pas produire)
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
            
            //Listage des dernières nomenclatures
            $listeAllVersionNomenclature = $em->getRepository('ICProductionBundle:VersionNomenclature')->getAllVersion();
            $i = 0;
            foreach($listeAllVersionNomenclature as $versionNomenclature)
            {
                if($i != $versionNomenclature->getNomenclature()->getId())
                {
                    $i = $versionNomenclature->getNomenclature()->getId();
                    $listLastNomenclature[] = $versionNomenclature;
                }
            }

            //Création du formulaire et affichage de la vue
            $form = $this->createForm(new ProductionType($listLastNomenclature));
            
            return $this->render('ICProductionBundle:Production:sousTraitant.html.twig', array('partie' => 'production',
                                                                                               'form' => $form->createView(),
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
    
    public function lancementProdAction($idProd)
    {
        //Connexion doctrine
        $em = $this->getDoctrine()->getManager();
        
        //selection de la production à lancer et la nomenclature pour sortir les composants du stock
        $production = $em->getRepository('ICProductionBundle:Production')->findOneBy(array('id' => $idProd));
        $composantNomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($production->getIdNomenclature());
        
        //Sortie des composants l'or de production interne
        if($production->getIdLieu() == 0)
        {
            foreach ($composantNomenclature as $composantNom)
            {
                $newQuantite = $composantNom->getComposant()->getStockInterne() - ($composantNom->getQuantite() * $production->getQuantite());
                
                $composant = $em->getRepository('ICProductionBundle:Composant')->find($composantNom->getComposant()->getId());
                
                $composant->setStockInterne($newQuantite);
            }
            
            $em->flush();           
        }
        //Sortie des composants l'or de production Sous traitant
        else
        {
            $composantUtilise = explode(',', $production->getComposantUtilise());
            
            foreach ($composantNomenclature as $composantNom)
            {
                $composantSt = $em->getRepository('ICProductionBundle:ComposantSousTraitant')->getComposantSt($production->getIdLieu());
                
                foreach ($composantSt as $sousTraitant) 
                {
                    if(in_array($sousTraitant->getIdComposant(), $composantUtilise))
                    {
                        if($sousTraitant->getIdComposant() == $composantNom->getIdComposant())
                        {
                            $newQuantite = $sousTraitant->getQuantite() - ($composantNom->getQuantite() * $production->getQuantite());
                            
                            $sousTraitant->setQuantite($newQuantite);                                                             
                        }
                    }
                }
                
                $em->flush();
            }                
        }
        
        //Passage de la production de l'etape 1(prévisionnelle) à l'étape 2(prod)
        $production->setEtape(2);
        $production->setDateProd(new \Datetime());
        $em->flush();
        
        //redirection vers l'affichage
        if($production->getIdLieu() == 0)
            return $this->redirectToRoute('ic_production_interne');
        else
            return $this->redirectToRoute('ic_production_sous_traitant', array('id' => $production->getIdLieu()));
    }
    
    public function lancementTestAction($idProd)
    {
        //Connexion doctrine
        $em = $this->getDoctrine()->getManager();
        
        //sélection de la production qui vient d'être terminée
        $production = $em->getRepository('ICProductionBundle:Production')->findOneBy(array('id' => $idProd));
        $idProducteur = $production->getIdLieu();
        
        //création du lot de lecteur
        $lot = new Lot();
        $lot->setIdnomenclature($production->getVersion()->getVersion());
        $lot->setDateProd($production->getDateProd());
        $lot->setDateTest(new \Datetime());
        
        $em->persist($lot);
        $em->flush();
        
        //recupération du lot créé précédement
        $lastLot = $em->getRepository('ICProductionBundle:Lot')->getLastLot();
        
        //création de la liste de carte à tester ainsi que leurs numéro de série
        for($i =0; $i < $production->getQuantite(); $i++)
        {
            while(true)
            {
                $rand = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                
                //vérification que le numéro généré n'est pas déja utilisé
                $verifDispoLecteur = $em->getRepository('ICProductionBundle:Lecteur')->findOneBy(array('numSerie' => $rand));
                $verifDispoCarteTest = $em->getRepository('ICProductionBundle:CarteTest')->findOneBy(array('numSerie' => $rand));
                
                //s'il n'est pas utilisé on ajoute le ligne dans CarteTest
                if(empty($verifDispo) && empty($verifDispoCarteTest))
                {
                    $lecteurTest = new CarteTest();  
                    $lecteurTest->setNumSerie($rand);
                    $lecteurTest->setIdLot($lastLot[0]->getId());
                    $lecteurTest->setEtat(1);
                    $lecteurTest->setAssemble(0);
                    
                    $em->persist($lecteurTest);
                    $em->flush();
                    break;
                }
            }
        }
        
        //Supréssion de la production terminée
        $em->remove($production);
        $em->flush();
        
        //redirection vers l'affichage        
        if($idProducteur == 0)
            return $this->redirectToRoute('ic_production_interne');
        else
            return $this->redirectToRoute('ic_production_sous_traitant', array('id' => $idProducteur));
    }
    
    public function suppressionAction($idProd)
    {
        //Connexion doctrine
        $em = $this->getDoctrine()->getManager();
        
        $production = $em->getRepository('ICProductionBundle:Production')->findOneBy(array('id' => $idProd));
        $idProducteur = $production->getIdLieu();
        
        $em->remove($production);
        $em->flush();
        
        //redirection vers l'affichage
        if($idProducteur == 0)
            return $this->redirectToRoute('ic_production_interne');
        else
            return $this->redirectToRoute('ic_production_sous_traitant', array('id' => $idProducteur));
    }
}