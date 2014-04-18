<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CiudadController extends Controller
{
    public function ciudadesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ciudades = $em->getRepository('SMAdminBundle:Ciudad')->findAll();

        return $this->render('SMAdminBundle:Ciudad:index.html.twig', array(
            'ciudades' => $ciudades
        ));
    }

    public function editAction($id)
    {
        return new Response("Pendiente.");
    }
}
