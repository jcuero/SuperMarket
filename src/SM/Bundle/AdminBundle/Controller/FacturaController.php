<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FacturaController extends Controller 
{
    public function indexAction() {
        return $this->render('SMAdminBundle:Factura:index.html.twig');
    }

    public function editAction($id) {
        return new Response("Pendiente.");
    }

    public function buscarProductoAction() {
        return $this->render('SMAdminBundle:Factura:index.html.twig');
    }

}
