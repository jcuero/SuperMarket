<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\Departamento;
use SM\Bundle\AdminBundle\Form\Type\DepartamentoType;

class DepartamentoController extends Controller 
{
    /**
     * Lista y muestra todos los departamentos en forma de paginacion.
     * 
     */
    public function indexAction() 
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('SMAdminBundle:Departamento')->findAll();

        // añadimos el paginador
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $departamentos,
            $this->get('request')->query->get('page', 1), 10
        );

        return $this->render('SMAdminBundle:Departamento:index.html.twig', array(
                    'departamentos' => $departamentos,
                    'departamentosPadinados' => $pagination
        ));
    }


    /**
     *  Muestra un formulario vacio y crea una nuevo departamento.
     * 
     */
    public function newAction() 
    {
        $departamento = new Departamento();
        $request = $this->getRequest();
        $formulario = $this->createForm(new DepartamentoType(), $departamento, array(
            'action' => $this->generateUrl('sm_admin_departamento_new'),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) 
        {
            $this->get('session')->getFlashBag()->add('success', 'El clietne ha sido creado correctamente.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($departamento);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_departamento_new'));
        }

        return $this->render('SMAdminBundle:Departamento:new.html.twig', array(
                    'departamento' => $departamento,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Muestra un formulario con la información del departamento 
     * que se desea editar. 
     * 
     */
    public function editAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $departamento = $em->find('SMAdminBundle:Departamento', $id);

        if (!$departamento) {
            throw $this->createNotFoundException('No se ha encontrado el departamento solicitado');
        }

        $formulario = $this->createForm(new DepartamentoType(), $departamento, array(
            'action' => $this->generateUrl('sm_admin_departamento_edit', array('id' => $id)),
            'method' => 'POST',
        ));

        $formulario->handleRequest($request);

        if ($formulario->isValid()) {
            $em->persist($departamento);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_departamento'));
        }

        return $this->render('SMAdminBundle:Departamento:edit.html.twig', array(
                    'departamento' => $departamento,
                    'formulario' => $formulario->createView()
        ));
    }

    /**
     * Elimina un departamento
     * 
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $departamento = $em->find('SMAdminBundle:Departamento', $id);

        if(!$departamento){
              throw $this->createNotFoundException('No se ha encontrado el departamento solicitado');
        }

        try{
            $em->remove($departamento);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Se ha eliminado el departamento.');
        } catch(\Exception $exc){
            $this->get('session')->getFlashBag()->add('error', 'No es posible eliminar el departamento, tiene relaciones activas.'); 
        }

        return $this->redirect($this->generateUrl('sm_admin_departamento'));
    }

}
