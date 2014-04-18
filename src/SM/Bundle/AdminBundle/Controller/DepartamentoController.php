<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use SM\Bundle\AdminBundle\Entity\Departamento;
use SM\Bundle\AdminBundle\Form\Type\DepartamentoType;

class DepartamentoController extends Controller
{
    public function departamentosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('SMAdminBundle:Departamento')->findAll();

        return $this->render('SMAdminBundle:Departamento:index.html.twig', array(
            'departamentos' => $departamentos
        ));
    }

    public function newAction()
    {
        $departamento = new Departamento();
        $request = $this->getRequest();
        $form = $this->createForm(new DepartamentoType(), $departamento, array(
            'action' => $this->generateUrl('sm_admin_departamento_new'),
            'method' => 'POST',
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departamento);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_departamento'));
        }

        return $this->render('SMAdminBundle:Departamento:new.html.twig', array(
            'departamento' => $departamento,
            'form'   => $form->createView()
        ));
    }    

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $departamento = $em->find('SMAdminBundle:Departamento' , $id);

        if(!$departamento){
            throw $this->createNotFoundException('No se ha encontrado el departamento solicitado');
        }

        $form = $this->createForm(new DepartamentoType(), $departamento, array(
            'action' => $this->generateUrl('sm_admin_departamento_edit', array('id' => $id)),
            'method' => 'POST',
            ));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($departamento);
            $em->flush();

            return $this->redirect($this->generateUrl('sm_admin_departamento'));
        }

        return $this->render('SMAdminBundle:Departamento:edit.html.twig', array(
            'departamento' => $departamento,
            'form'   => $form->createView()
        ));
    }
}
