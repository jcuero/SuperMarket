<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PortadaController extends Controller 
{
    public function indexAction() 
    {
    	$em = $this->getDoctrine()->getManager();
    	$incidentes = $em->getRepository('SMAdminBundle:DetalleIncidente')->findAll();


        return $this->render('SMAdminBundle:Portada:index.html.twig', array(
                    'incidentes' => $incidentes
        ));
    }
}
