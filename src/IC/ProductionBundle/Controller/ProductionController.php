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
        
        //AFFICHAGE LISTE COMPOSANT NOMENCLATURE
        if('POST' == $request->getMethod() && isset($data['versionNomenclature']))
        {
            //Récupération de la derniere version de la nomenclature
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->getVersion($data['versionNomenclature']);
            $idVersion = $version[0]->getId();
            $version = $version[0]->getVersion();
            
            //recupération de la liste des composant nécéssaire à la production, le nb de prod manquant et le nom de la nomenclature
            $info = $this->container->get('ic_production')->getListComposantNomenclatureInterne($data, $idVersion);
            list($tabComposant, $nbProdManquant, $nomenclature) = $info;
            
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
            //recupération des information pour afficher les deux tableau de production
            $info = $this->container->get('ic_production')->getTabProdInterne();
            list($listeEnCours, $listePrevisionnelle) = $info;
            
            //Listage des dernières nomenclatures
            $listLastNomenclature = $this->container->get('ic_production')->listLastNomenclature();

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
            
            //recupération de la liste des composant nécéssaire à la production, le nb de prod manquant et le nom de la nomenclature
            $info = $this->container->get('ic_production')->getListComposantNomenclatureSousTraitant($data, $idVersion, $id);
            list($tabComposant, $nbProdManquant, $nomenclature) = $info;            
           
            return $this->render('ICProductionBundle:Liste:sousTraitant.html.twig', array('partie' => 'production',
                                                                                          'id' => $id,
                                                                                          'quantite' => $data['quantite'],
                                                                                          'composantNomenclature' => $tabComposant,       
                                                                                          'nomenclature' => $nomenclature,
                                                                                          'idVersion' => $idVersion,
                                                                                          'version' => $version,
                                                                                          'nbProdManquant' => $nbProdManquant));   
                   
        }
        //AFFICHAGE DES TABLEAUX PREVISIONNEL ET EN PROD EN COURS
        else
        {
            $info = $this->container->get('ic_production')->getTabProdSousTraitant($id);
            list($listeEnCours, $listePrevisionnelle) = $info;
            
            //Listage des dernières nomenclatures
            $listLastNomenclature = $this->container->get('ic_production')->listLastNomenclature();

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
            $option = $request->get('option');
            
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
            
            if(isset($option))
            {
                $listeComposant = '';
                
                foreach ($option as $value)
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
            }   
            $em->flush();             
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
        for($i = 0, $i1 = 1; $i < $production->getQuantite(); $i++, $i1++)
        {
            while(true)
            {
                $rand = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                
                //vérification que le numéro généré n'est pas déja utilisé
                $verifDispoLecteur = $em->getRepository('ICProductionBundle:Lecteur')->findOneBy(array('numSerie' => $rand));
                $verifDispoCarteTest = $em->getRepository('ICProductionBundle:CarteTest')->findOneBy(array('numSerie' => $rand));
                
                //s'il n'est pas utilisé on ajoute le ligne dans CarteTest
                if(empty($verifDispoLecteur) && empty($verifDispoCarteTest))
                {
                    $lecteurTest = new CarteTest();  
                    $lecteurTest->setNumSerie($rand);
                    $lecteurTest->setIdLot($lastLot[0]->getId());
                    $lecteurTest->setEtat(1);
                    $lecteurTest->setAssemble(0);
                    
                    $em->persist($lecteurTest);
                    break;
                }
            }
            
            if($i1 == 3000 || $production->getQuantite() == $i + 1)
            {
                $i1 = 0;
                $em->flush();
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
