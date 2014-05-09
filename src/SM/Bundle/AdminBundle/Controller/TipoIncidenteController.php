<?php 

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\TipoIncidente;
use SM\Bundle\AdminBundle\Form\Type\TipoIncidenteType;

class TipoIncidenteController extends Controller
{

    /**
     * Lista y muestra todos los tipos de incidentes en forma de paginación.
     * 
     */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$tiposIncidentes = $em->getRepository('SMAdminBundle:TipoIncidente')->findAll();

		// añadimos el paginador
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $tiposIncidentes,
            $this->get('request')->query->get('page', 1), 
            10
        );

        return $this->render('SMAdminBundle:TipoIncidente:index.html.twig', array(
                    'tiposIncidentes' => $tiposIncidentes,
                    'tiposIncidentesPadinados' => $pagination
        ));
	}

    /**
     *  Muestra un formulario vacio y crea un nuevo tipo de incidente.
     * 
     */
    public function newAction() 
    {
        $tipoIncidente = new TipoIncidente();
        $request = $this->getRequest();
        $formulario = $this->createForm(new TipoIncidenteType(), $tipoIncidente);

        $formulario->handleRequest($request);

        if($formulario->isValid())
        {
            $this->get('session')->getFlashBag()->add('success', 'El tipo de incidente ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoIncidente);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_tipo_incidente_new'));
        }  

        return $this->render('SMAdminBundle:TipoIncidente:new.html.twig', array(
                    'tipoIncidente' => $tipoIncidente,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Muestra un formulario con la información del tipo de incidente 
     * que se desea editar. 
     * 
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $tipoIncidente = $em->find('SMAdminBundle:TipoIncidente', $id);

        if(!$tipoIncidente)
        {
            throw $this->createNotFoundException('No se ha encontrado el cliente solicitado');
        }

        $formulario = $this->createForm(new TipoIncidenteType(), $tipoIncidente, array(
            'action' => $this->generateUrl('sm_admin_tipo_incidente_edit', array('id' => $id)),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if($formulario->isValid())
        {
            $em->persist($tipoIncidente);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_tipo_incidente'));
        }

        return $this->render('SMAdminBundle:TipoIncidente:edit.html.twig', array(
            'tipoIncidente' => $tipoIncidente,
            'formulario' => $formulario->createView()
        ));

    }

    /**
     * Elimina un tipo de incidente.
     * 
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tipoIncidente = $em->find('SMAdminBundle:TipoIncidente', $id);

        if(!$tipoIncidente){
              throw $this->createNotFoundException('No se ha encontrado el tipo de incidente solicitado');
        }

        try{
            $em->remove($tipoIncidente);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Se ha eliminado el tipo incidente ');
        } catch(\Exception $exc){
            $this->get('session')->getFlashBag()->add('error', 'No es posible eliminar el tipo de incidente, tiene relaciones activas.'); 
        }

        return $this->redirect($this->generateUrl('sm_admin_tipo_incidente'));
    }

}