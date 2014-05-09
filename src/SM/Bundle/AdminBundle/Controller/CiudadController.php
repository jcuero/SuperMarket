<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\Ciudad;
use SM\Bundle\AdminBundle\Form\Type\CiudadType;

class CiudadController extends Controller 
{
    /**
     * Lista y muestra todas las ciudades en forma de paginacion.
     * 
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getManager();

        $ciudades = $em->getRepository('SMAdminBundle:Ciudad')->findAll();

        // añadimos el paginador
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $ciudades,
            $this->get('request')->query->get('page', 1), 10
        );

        return $this->render('SMAdminBundle:Ciudad:index.html.twig', array(
                    'ciudades' => $ciudades,
                    'ciudadesPadinadas' => $pagination
        ));
    }

    /**
     *  Muestra un formulario vacio y crea una nueva ciudad.
     * 
     */
    public function newAction() 
    {
        $ciudad = new Ciudad();
        $request = $this->getRequest();
        $formulario = $this->createForm(new CiudadType(), $ciudad);

        $formulario->handleRequest($request);

        if ($formulario->isValid()) 
        {
            $this->get('session')->getFlashBag()->add('success', 'La ciudad ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($ciudad);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_ciudad_new'));
        }

        return $this->render('SMAdminBundle:Ciudad:new.html.twig', array(
                    'ciudad' => $ciudad,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Muestra un formulario con la información de la ciudad 
     * que se desea editar. 
     * 
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $ciudad = $em->find('SMAdminBundle:Ciudad', $id);

        if (!$ciudad) {
            throw $this->createNotFoundException('No se ha encontrado el ciudad solicitado');
        }

        $formulario = $this->createForm(new CiudadType(), $ciudad, array(
            'action' => $this->generateUrl('sm_admin_ciudad_edit', array('id' => $id)),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em->persist($ciudad);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_ciudad'));
        }

        return $this->render('SMAdminBundle:Ciudad:edit.html.twig', array(
                    'ciudad' => $ciudad,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Elimina una ciudad.
     * 
     */
    public function deleteAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $ciudad = $em->find('SMAdminBundle:Ciudad', $id);

        if (!$ciudad) {
            throw $this->createNotFoundException('No se ha encontrado la ciudad solicitado');
        }

        try{
            $em->remove($ciudad);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Se ha eliminado la ciudad.');
        } catch(\Exception $exc){
            $this->get('session')->getFlashBag()->add('error', 'No se ha podido eliminar la ciudad, tiene ralaciones activas.');
        }

        return $this->redirect($this->generateUrl('sm_admin_ciudad'));
    }

}
