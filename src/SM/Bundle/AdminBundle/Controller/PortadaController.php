<?php

namespace SM\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PortadaController extends Controller 
{
    public function indexAction() 
    {
        return $this->render('SMAdminBundle:Portada:index.html.twig');
    }
}
