<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    public function clientesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clientes = $em->getRepository('SMAdminBundle:Cliente')->findAll();

        return $this->render('SMAdminBundle:Cliente:index.html.twig', array(
            'clientes' => $clientes
        ));
    }

    public function editAction($id)
    {
    	return new Response("Pendiente.");
    }
}
