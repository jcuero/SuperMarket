<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\Producto;
use SM\Bundle\AdminBundle\Form\Type\ProductoType;

class ProductoController extends Controller
{
    public function productosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productos = $em->getRepository('SMAdminBundle:Producto')->findAll();

        return $this->render('SMAdminBundle:Producto:index.html.twig', array(
            'productos' => $productos
        ));
    }


    public function newAction()
    {
        $producto = new Producto();
        $request = $this->getRequest();
        $form = $this->createForm(new ProductoType(), $producto, array(
            'action' => $this->generateUrl('sm_admin_producto_new'),
            'method' => 'POST',
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_producto'));
        }

        return $this->render('SMAdminBundle:Producto:new.html.twig', array(
            'producto' => $producto,
            'form'   => $form->createView()
        ));
    }    

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $producto = $em->find('SMAdminBundle:Producto' , $id);

        if(!$producto){
            throw $this->createNotFoundException('No se ha encontrado el producto solicitado');
        }

        $form = $this->createForm(new ProductoType(), $producto, array(
            'action' => $this->generateUrl('sm_admin_producto_edit', array('id' => $id)),
            'method' => 'POST',
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($producto);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_producto'));
        }

        return $this->render('SMAdminBundle:Producto:edit.html.twig', array(
            'producto' => $producto,
            'form'   => $form->createView()
        ));
    }
}
