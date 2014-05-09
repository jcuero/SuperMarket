<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\ClaseProducto;
use SM\Bundle\AdminBundle\Form\Type\ClaseProductoType;

class ClaseProductoController extends Controller 
{
    /**
     * Lista y muestra todas las clases de producto existentes paginadas.
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getManager();

        $claseProductos = $em->getRepository('SMAdminBundle:ClaseProducto')->findAll();

        // añadimos el paginador
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $claseProductos,
            $this->get('request')->query->get('page', 1), 10
        );

        return $this->render('SMAdminBundle:ClaseProducto:index.html.twig', array(
                    'claseProductos' => $claseProductos,
                    'claseProductosPadinados' => $pagination
        ));
    }


    /**
     *  Muestra un formulario vacio y crea una nueva clase de producto.
     * 
     */
    public function newAction() 
    {
        $claseProducto = new ClaseProducto();
        $request = $this->getRequest();
        $formulario = $this->createForm(new claseProductoType(), $claseProducto, array(
            'action' => $this->generateUrl('sm_admin_clase_producto_new'),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) 
        {
            $this->get('session')->getFlashBag()->add('success', 'La clase de producto ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($claseProducto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_clase_producto_new'));
        }

        return $this->render('SMAdminBundle:ClaseProducto:new.html.twig', array(
                    'claseProducto' => $claseProducto,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Muestra un formulario con la información de 
     * la clase de producto que se desea editar. 
     * 
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $claseProducto = $em->find('SMAdminBundle:ClaseProducto', $id);

        if (!$claseProducto) {
            throw $this->createNotFoundException('No se ha encontrado el claseProducto solicitado');
        }

        $formulario = $this->createForm(new ClaseProductoType(), $claseProducto, array(
            'action' => $this->generateUrl('sm_admin_clase_producto_edit', array('id' => $id)),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em->persist($claseProducto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_clase_producto'));
        }

        return $this->render('SMAdminBundle:ClaseProducto:edit.html.twig', array(
                    'claseProducto' => $claseProducto,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Elimina una clase de producto.
     * 
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $claseProducto = $em->find('SMAdminBundle:ClaseProducto', $id);

        if(!$claseProducto){
              throw $this->createNotFoundException('No se ha encontrado la clase de producto solicitada');
        }

        try{
            $em->remove($claseProducto);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Se ha eliminado la clase de producto.');
        } catch(\Exception $exc){
            $this->get('session')->getFlashBag()->add('error', 'No es posible eliminar la clase producto, tiene relaciones activas.'); 
        }

        return $this->redirect($this->generateUrl('sm_admin_clase_producto'));
    }

    public function searchAction()
    {
        return new Response('Pendiente...');
    }

}
