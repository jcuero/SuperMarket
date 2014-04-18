<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\ClaseProducto;
use SM\Bundle\AdminBundle\Form\Type\ClaseProductoType;

class ClaseProductoController extends Controller
{
    public function claseProductosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $claseProductos = $em->getRepository('SMAdminBundle:ClaseProducto')->findAll();

        return $this->render('SMAdminBundle:ClaseProducto:index.html.twig', array(
            'claseProductos' => $claseProductos
        ));
    }

    public function newAction()
    {
        $claseProducto = new ClaseProducto();
        $request = $this->getRequest();
        $form = $this->createForm(new claseProductoType(), $claseProducto, array(
            'action' => $this->generateUrl('sm_admin_clase_producto_new'),
            'method' => 'POST',
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($claseProducto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_clase_producto'));
        }

        return $this->render('SMAdminBundle:ClaseProducto:new.html.twig', array(
            'claseProducto' => $claseProducto,
            'form'   => $form->createView()
        ));
    }    

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $claseProducto = $em->find('SMAdminBundle:ClaseProducto' , $id);

        if(!$claseProducto){
            throw $this->createNotFoundException('No se ha encontrado el claseProducto solicitado');
        }

        $form = $this->createForm(new ClaseProductoType(), $claseProducto, array(
            'action' => $this->generateUrl('sm_admin_clase_producto_edit', array('id' => $id)),
            'method' => 'POST',
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($claseProducto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_clase_producto'));
        }

        return $this->render('SMAdminBundle:ClaseProducto:edit.html.twig', array(
            'claseProducto' => $claseProducto,
            'form'   => $form->createView()
        ));
    }
}
