<?php
namespace IC\ProductionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use IC\ProductionBundle\Form\Type\ProductionType;

class ProductionController extends Controller
{
    public function interneAction(Request $request)
    {
        
        //Création du formulaire
        $form = $this->createForm(new ProductionType($listNomenclature));
        
        if('POST' == $request->getMethod())
        {
            var_dump($_POST);$listeComposantnomenclature = $this->getDoctrine()->getManager()->getRepository('ICProductionBundle:ComposantNomenclature')->getComposantNomenclatureProdInterne($_POST['formProduction']['nomenclature']);
            return $this->render('ICProductionBundle:Liste:interne.html.twig', array('quantite'  => $_POST['formProduction']['quantite'], 'composantNomenclature' => $listeComposantnomenclature));            
        }
        else
        {
            return $this->render('ICProductionBundle:Production:interne.html.twig', array('form' => $form->createView()));
        }
    }
    
    public function sousTraitantAction($id)
    {
        return $this->render('ICProductionBundle:Production:sousTraitant.html.twig');
    }
}
