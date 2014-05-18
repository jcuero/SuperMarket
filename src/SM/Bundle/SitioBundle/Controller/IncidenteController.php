<?php

namespace SM\Bundle\SitioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SM\Bundle\AdminBundle\Entity\DetalleIncidente;
use SM\Bundle\SitioBundle\Form\Type\DetalleIncidenteType;


class IncidenteController extends Controller
{
    public function indexAction()
    {
        //return $this->render('SMSitioBundle:Incidente:index.html.twig');
        return $this->newAction();
    }

    /**
     *  Muestra un formulario vacio y crea un nuevo incidente.
     * 
     */
    public function newAction() 
    {
        $detalleIncidente = new DetalleIncidente();
        $request = $this->getRequest();
        $formulario = $this->createForm(new DetalleIncidenteType(), $detalleIncidente);

        $formulario->handleRequest($request);

        if ($formulario->isValid()) 
        {
            $this->get('session')->getFlashBag()->add('success', 'El detalle de incidente ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($detalleIncidente);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_sitio_incidente'));
        }

        return $this->render('SMSitioBundle:Incidente:index.html.twig', array(
                    'detalleIncidente' => $detalleIncidente,
                    'formulario' => $formulario->createView()
        ));
    }
}