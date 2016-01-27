<?php

namespace IC\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\AdministrationBundle\Entity\Nomenclature;
use IC\AdministrationBundle\Entity\ComposantNomenclature;
use IC\AdministrationBundle\Entity\ProduitFiniNomenclature;
use IC\AdministrationBundle\Entity\VersionNomenclature;

class NomenclatureController extends Controller
{
    public function affichageNomenclatureAction($allVersion, $idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();

        $nomenclatures = $em->getRepository('ICAdministrationBundle:VersionNomenclature')->getLastVersionNomenclature($allVersion);

        return $this->render('ICAdministrationBundle:nomenclature:affichage.html.twig', array('partie' => 'Administration', 
                                                                                              'nomenclatures' => $nomenclatures, 
                                                                                              'allVersion' => $allVersion,
                                                                                              'modifNomenclature' => $idNomenclature));
    }
    
    public function affichageComposantNomenclatureAction($idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();
        
        $composantNomenclature = $em->getRepository('ICAdministrationBundle:ComposantNomenclature')->getComposantByNomenclature($idNomenclature);
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->getComposantPCB();

        return $this->render('ICAdministrationBundle:nomenclature:affichageComposantPCB.html.twig', array('partie' => 'Administration',
                                                                                                          'idNomenclature' => $idNomenclature,
                                                                                                          'composants' => $composant,                                                                                                          
                                                                                                          'composantsNomenclature' => $composantNomenclature));        
    }
    
    public function affichageProduitFiniNomenclatureAction($idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();
        
        $produitFiniNomenclature = $em->getRepository('ICAdministrationBundle:ProduitFiniNomenclature')->getComposantByNomenclature($idNomenclature);
        $composant = $em->getRepository('ICAdministrationBundle:Composant')->getComposantProduitFini();
        
        return $this->render('ICAdministrationBundle:nomenclature:affichageProduitFini.html.twig', array('partie' => 'Administration',
                                                                                                         'idNomenclature' => $idNomenclature, 
                                                                                                         'composants' => $composant,
                                                                                                         'produitsFinisNomenclature' => $produitFiniNomenclature));   
    }
    
    public function ajouterNomenclatureAction(request $request)
    {
        $vide = $request->get('nomenclature');
        if(!empty($vide))
        {
            $em = $this->getDoctrine()->getManager();
            
            $nomenclature = new Nomenclature();
            $nomenclature->setNom($request->get('nomenclature'));
            $em->persist($nomenclature);
            $em->flush();
            
            $lastNomenclature = $em->getRepository('ICAdministrationBundle:Nomenclature')->getLastNomenclature();
            
            $versionNomenclature = new VersionNomenclature();
            $versionNomenclature->setNomenclature($lastNomenclature[0]);
            $versionNomenclature->setVersion(1);
            $em->persist($versionNomenclature);
            $em->flush();
        }
        
        return $this->redirectToRoute('ic_administration_nomenclature');
    }
        
    public function ajouterVersionNomenclatureAction($idNomenclature)
    {
            $em = $this->getDoctrine()->getManager();
        
            $lastVersion = $em->getRepository('ICAdministrationBundle:VersionNomenclature')->getLastVersionByNomenclature($idNomenclature);
            $nomenclature = $em->getRepository('ICAdministrationBundle:Nomenclature')->find($idNomenclature);
            
            $versionNomenclature = new VersionNomenclature();
            $versionNomenclature->setNomenclature($nomenclature);
            $versionNomenclature->setVersion($lastVersion[0]->getVersion() + 1);
            $em->persist($versionNomenclature);
            $em->flush();
            
            return $this->redirectToRoute('ic_administration_nomenclature');
    }
    
    public function modifierNomenclatureAction(request $request, $idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();
        
        $nomenclature = $em->getRepository('ICAdministrationBundle:Nomenclature')->find($idNomenclature);
        
        $nomenclature->setNom($request->get('nomNomenclature'));
        $em->persist($nomenclature);
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_nomenclature');
    } 
       
    public function modifierNomenclatureComposantAction(request $request, $idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();
        
        $versionNomenclature = $em->getRepository('ICAdministrationBundle:VersionNomenclature')->find($idNomenclature);
        $listComposantNomenclature = $em->getRepository('ICAdministrationBundle:ComposantNomenclature')->findBy(array('idVersion' => $idNomenclature));
        
        if(!empty($listComposantNomenclature))
        {
            foreach ($listComposantNomenclature as $composantNomenclature) 
            {
                $em->remove($composantNomenclature);
            }
            $em->flush();
        }
        
        foreach ($request->get('listId') as $id)
        {
			$vide = $request->get($id);
            if(!empty($vide))
            {
                $composant = $em->getRepository('ICAdministrationBundle:Composant')->find($id);
                
                $composantNomenclature = new ComposantNomenclature();
                $composantNomenclature->setComposant($composant);
                $composantNomenclature->setVersion($versionNomenclature);
                $composantNomenclature->setQuantite($request->get($id));
                $composantNomenclature->setPosition($request->get('position'.$id));
                
				$vide =$request->get('optionSt');
                if(!empty($vide))
                {
                    $existe = 0;
                    foreach ($request->get('optionSt') as $option) 
                    {
                        if($option == $id)
                        {
                            $existe = 1;
                            $composantNomenclature->setOptionSt(1);
                        }
                    }
                    
                    if($existe == 0)
                        $composantNomenclature->setOptionSt(0);
                }
                else
                    $composantNomenclature->setOptionSt(0);
                    
                $em->persist($composantNomenclature);
            }
        }
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_nomenclature');
    }
        
    public function modifierNomenclatureProduitFiniAction(request $request, $idNomenclature)
    {
        $em = $this->getDoctrine()->getManager();
        
        $versionNomenclature = $em->getRepository('ICAdministrationBundle:VersionNomenclature')->find($idNomenclature);
        $listProduitFiniNomenclature = $em->getRepository('ICAdministrationBundle:ProduitFiniNomenclature')->findBy(array('idVersion' => $idNomenclature));
        
        if(!empty($listProduitFiniNomenclature))
        {
            foreach ($listProduitFiniNomenclature as $produitFiniNomenclature) 
            {
                $em->remove($produitFiniNomenclature);
            }
            $em->flush();
        }
        
        foreach ($request->get('listId') as $id)
        {
            $vide = $request->get($id);
            if(!empty($vide))
            {
                $composant = $em->getRepository('ICAdministrationBundle:Composant')->find($id);
                
                $produitFiniNomenclature = new ProduitFiniNomenclature();
                
                $produitFiniNomenclature->setComposant($composant);
                $produitFiniNomenclature->setVersion($versionNomenclature);
                $produitFiniNomenclature->setQuantite($request->get($id));                                
                    
                $em->persist($produitFiniNomenclature);
            }
        }
        $em->flush();
        
        return $this->redirectToRoute('ic_administration_nomenclature');
    }
}
