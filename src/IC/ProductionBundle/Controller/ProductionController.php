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
        
        if('POST' == $request->getMethod())
        {    
            $em = $this->getDoctrine()->getManager();
            
            //Récupération de la derniere version de la nomenclature et les composants qui y sont liés
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->getVersion($_POST['formProduction']['nomenclature']);
            $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($version[0]->getId());         

            //déclaration à 0 du nombre de carte qui ne pourront pas etre produites
            $nbProdManquant = 0;
            
            //enregistrement du nom de la nomenclature et sa version
            $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();
            $version = $version[0]->getVersion(); 
                    
            $i = 0;
            //Calcul des cartes pouvant etre produites          
            foreach ($listeComposantnomenclature as $composant)
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
                                                                                     'version' => $version,
                                                                                     'nbProdManquant' => $nbProdManquant));            
        }
        else
        {
            //Création du formulaire et affichage de la vue
            $form = $this->createForm(new ProductionType());
            return $this->render('ICProductionBundle:Production:interne.html.twig', array('form' => $form->createView()));
        }
    }
    
    public function sousTraitantAction(Request $request, $id)
    {   
        if('POST' == $request->getMethod())
        {  
            $em = $this->getDoctrine()->getManager();
            
            //Récupération de la derniere version de la nomenclature et les composants qui y sont liés
            $version = $em->getRepository('ICProductionBundle:VersionNomenclature')->getVersion($_POST['formProduction']['nomenclature']);
            $ComposantSousTraitant = $em->getRepository('ICProductionBundle:ComposantSousTraitant')->getComposantSt($id);
            $listeComposantnomenclature = $em->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProd($version[0]->getId());  
            
            //déclaration à 0 du nombre de carte qui ne pourront pas etre produites
            $nbProdManquant = 0;
            
            //enregistrement du sous traitant, du nom de la nomenclature et sa version
            $nomSousTraitant = $ComposantSousTraitant[0]->getSousTraitant()->getNom();
            $nomenclature = $listeComposantnomenclature[0]->getVersion()->getNomenclature()->getNom();
            $version = $version[0]->getVersion();             
            
            $i = 0;
            //Calcul des cartes pouvant etre produites          
            foreach ($listeComposantnomenclature as $composant)
            {
                $calculStockRestant = 0 - ($composant->getQuantite() * $_POST['formProduction']['quantite']);
                
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
                                                                                          'version' => $version,
                                                                                          'nbProdManquant' => $nbProdManquant));            
        }
        else
        {
            
            //création du formulaire et affichage de la vue
            $form = $this->createForm(new ProductionType());  
            return $this->render('ICProductionBundle:Production:sousTraitant.html.twig', array('form' => $form->createView()));
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
