<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EmpleadoController extends Controller
{
    public function empleadosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $empleados = $em->getRepository('SMAdminBundle:Empleado')->findAll();

        return $this->render('SMAdminBundle:Empleado:index.html.twig', array(
            'empleados' => $empleados
        ));
    }

    public function editAction($id)
    {
        return new Response("Pendiente.");
    }
}
