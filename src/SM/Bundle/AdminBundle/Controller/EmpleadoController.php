<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\Empleado;
use SM\Bundle\AdminBundle\Form\Type\EmpleadoType;

class EmpleadoController extends Controller 
{
    /**
     * Lista y muestra todos los empleados en forma de paginacion.
     * 
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getManager();

        $empleados = $em->getRepository('SMAdminBundle:Empleado')->findAll();

        // añadimos el paginador
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $empleados,
            $this->get('request')->query->get('page', 1), 
            10
        );

        return $this->render('SMAdminBundle:Empleado:index.html.twig', array(
                    'empleados' => $empleados,
                    'empleadosPaginados' => $pagination
        ));
    }

    /**
     *  Muestra un formulario vacio y crea un nuevo empleado.
     * 
     */
    public function newAction()
    {
        $empleado = new Empleado();
        $request = $this->getRequest();
        $formulario = $this->createForm(new EmpleadoType(), $empleado);

        $formulario->handleRequest($request);

        if($formulario->isValid())
        {
            $this->get('session')->getFlashBag()->add('success', 'El empleado ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($empleado);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_empleado_new'));
        }

        return $this->render('SMAdminBundle:Empleado:new.html.twig', array(
                'empleado' => $empleado,
                'formulario' => $formulario->createView()
            ));
    }

    /**
     * Muestra un formulario con la información del empleado 
     * que se desea editar. 
     * 
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $empleado = $em->find('SMAdminBundle:Empleado', $id);

        if (!$empleado) {
            throw $this->createNotFoundException('No se ha encontrado el empleado solicitado');
        }

        $formulario = $this->createForm(new EmpleadoType(), $empleado, array(
            'action' => $this->generateUrl('sm_admin_empleado_edit', array('id' => $id)),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em->persist($empleado);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_empleado'));
        }

        return $this->render('SMAdminBundle:Empleado:edit.html.twig', array(
                    'empleado' => $empleado,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Elimina un empleado
     * 
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $empleado = $em->find('SMAdminBundle:Empleado', $id);

        if(!$empleado){
              throw $this->createNotFoundException('No se ha encontrado el empleado solicitado');
        }

        try{
            $em->remove($empleado);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Se ha eliminado el empleado.');
        } catch(\Exception $exc){
            $this->get('session')->getFlashBag()->add('error', 'No es posible eliminar el empleado, tiene relaciones activas.'); 
        }

        return $this->redirect($this->generateUrl('sm_admin_empleado'));
    }

}
