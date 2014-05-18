<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\Cliente;
use SM\Bundle\AdminBundle\Form\Type\ClienteType;

class ClienteController extends Controller 
{

    /**
     * Lista y muestra todos los clientes en forma de paginación.
     * 
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getManager();

        $clientes = $em->getRepository('SMAdminBundle:Cliente')->findAll();

        // añadimos el paginador
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $clientes,
            $this->get('request')->query->get('page', 1), 10
        );

        return $this->render('SMAdminBundle:Cliente:index.html.twig', array(
                    'clientes' => $clientes,
                    'clientesPadinados' => $pagination
        ));
    }

    /**
     *  Muestra un formulario vacio y crea una nuevo cliente.
     * 
     */
    public function newAction() 
    {
        $cliente = new Cliente();
        $request = $this->getRequest();
        $formulario = $this->createForm(new ClienteType(), $cliente);

        $formulario->handleRequest($request);

        if ($formulario->isValid()) 
        {
            $this->get('session')->getFlashBag()->add('success', 'El clietne ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($cliente);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_cliente_new'));
        }

        return $this->render('SMAdminBundle:Cliente:new.html.twig', array(
                    'cliente' => $cliente,
                    'formulario' => $formulario->createView()
        ));
    }


    /**
     * Muestra un formulario con la información del cliente 
     * que se desea editar. 
     * 
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $cliente = $em->find('SMAdminBundle:Cliente', $id);

        if (!$cliente) {
            throw $this->createNotFoundException('No se ha encontrado el cliente solicitado');
        }

        $formulario = $this->createForm(new ClienteType(), $cliente, array(
            'action' => $this->generateUrl('sm_admin_cliente_edit', array('id' => $id)),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em->persist($cliente);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_cliente'));
        }

        return $this->render('SMAdminBundle:Cliente:edit.html.twig', array(
                    'cliente' => $cliente,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Elimina un cliente
     * 
     */
    public function deleteAction($id) 
    {
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->find('SMAdminBundle:Cliente', $id);

        if (!$cliente) {
            throw $this->createNotFoundException('No se ha encontrado el cliente solicitado');
        }

        $this->get('session')->getFlashBag()->add('success', 'El cliente ha sido eliminado correctamente.');

        $em->remove($cliente);
        $em->flush();

        return $this->redirect($this->generateUrl('sm_admin_cliente'));
    }

    /**
    * Devuelve un cliente en formato json
    *
    */
    public function toJSONAction(){
        $cliente = null;
        $request = $this->getRequest();
        $cedula  = $request->query->get('cedula');

        try {
            $cliente = $this->search($cedula);    
        } catch (\Exception $e) {
            $this->get('session')->getFlashBag()->add('error', 'No se ha encontrado el cliente solicitado.');

            return new Response( json_encode(array('message' => 'No se ha encontrado el cliente solicitado.') ));
        }

        return new Response($cliente->toJSON());

    }

    /**
    * Busca y devuelve un cliente.
    *
    */
    public function search($cedula){
        $em      = $this->getDoctrine()->getManager();
        $cliente = $em->getRepository('SMAdminBundle:Cliente')->findOneByCedula($cedula);
        
        if (!$cliente) {
            throw $this->createNotFoundException('No se ha encontrado el cliente solicitado');
        }

        return $cliente;
    }

    public function ajaxAction(){
        return $this->render('SMAdminBundle:Cliente:json.html.twig');
    }

}
