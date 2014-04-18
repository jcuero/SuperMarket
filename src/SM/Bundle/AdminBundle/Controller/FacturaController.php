<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FacturaController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SMAdminBundle:Default:index.html.twig', array('name' => $name));
    }

    public function editAction($id)
    {
    	return new Response("Pendiente.");
    }
}
