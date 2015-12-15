<?php

namespace IC\AffichageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ComposantController extends Controller
{
    public function interneAction(Request $request)
    {
        if('POST' == $request->getMethod())
            if($_POST['formComposantInterne']['fournisseur'])
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST['formComposantInterne']);
            else
                $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockFournisseurByCritere($_POST['formComposantInterne']);
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->findAll();
                var_dump($_POST);
        return $this->render('ICAffichageBundle:Composant:interne.html.twig', array('composants' => $listComposant));
    }
    
    public function soustraitantAction(Request $request, $id)
    {
        if('POST' == $request->getMethod())
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:Composant')->getStockByCritere($_POST);
        else
            $listComposant = $this->getDoctrine()->getManager()->getRepository('ICAffichageBundle:ComposantSousTraitant')->getComposantSousTraitantById($id);  
                  
        return $this->render('ICAffichageBundle:Composant:sousTraitant.html.twig', array('composantSousTraitants'=> $listComposant));
    }
}
