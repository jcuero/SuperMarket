<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\Producto;
use SM\Bundle\AdminBundle\Form\Type\ProductoType;

class ProductoController extends Controller 
{
    /**
     * Lista y muestra todos los productos en forma de paginación.
     * 
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('SMAdminBundle:Producto')->findAll();

        // añadimos el paginador
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $productos,
            $this->get('request')->query->get('page', 1), 
            10
        );

        return $this->render('SMAdminBundle:Producto:index.html.twig', array(
                    'productos' => $productos,
                    'productosPadinados' => $pagination
        ));
    }

    /**
     *  Muestra un formulario vacio y crea una nuevo producto.
     * 
     */
    public function newAction() 
    {
        $producto = new Producto();
        $request = $this->getRequest();
        $formulario = $this->createForm(new ProductoType(), $producto, array(
            'action' => $this->generateUrl('sm_admin_producto_new'),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) 
        {
            $this->get('session')->getFlashBag()->add('success', 'El producto ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_producto_new'));
        }

        return $this->render('SMAdminBundle:Producto:new.html.twig', array(
                    'producto' => $producto,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Muestra un formulario con la información del producto 
     * que se desea editar. 
     * 
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $producto = $em->find('SMAdminBundle:Producto', $id);

        if (!$producto) {
            throw $this->createNotFoundException('No se ha encontrado el producto solicitado');
        }

        $formulario = $this->createForm(new ProductoType(), $producto, array(
            'action' => $this->generateUrl('sm_admin_producto_edit', array('id' => $id)),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) 
        {
            $em->persist($producto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_producto'));
        }

        return $this->render('SMAdminBundle:Producto:edit.html.twig', array(
                    'producto' => $producto,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Elimina un producto
     * 
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $producto = $em->find('SMAdminBundle:Producto', $id);

        if(!$producto){
              throw $this->createNotFoundException('No se ha encontrado el producto solicitado');
        }

        try{
            $em->remove($producto);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Se ha eliminado el producto.');
        } catch(\Exception $exc){
            $this->get('session')->getFlashBag()->add('error', 'No es posible eliminar el producto, tiene relaciones activas.'); 
        }

        return $this->redirect($this->generateUrl('sm_admin_producto'));
    }

    /**
    * Devuelve un producto en formato json
    *
    */
    public function toJSONAction(){
        $producto = null;
        $request = $this->getRequest();
        $codigo  = $request->query->get('codigo');

        try {
            $producto = $this->search($codigo);    
        } catch (\Exception $e) {
            return new Response( json_encode(array('message' => 'No se ha encontrado el producto solicitado.') ));
        }

        return new Response($producto->toJSON());
    }

    /**
    * Busca y devuelve un producto por su código.
    *
    */
    public function search($codigo){
        $em      = $this->getDoctrine()->getManager();
        $producto = $em->getRepository('SMAdminBundle:Producto')->findOneByCodigo($codigo);
        
        if (!$producto) {
            throw $this->createNotFoundException('No se ha encontrado el producto solicitado');
        }

        return $producto;
    }
}
