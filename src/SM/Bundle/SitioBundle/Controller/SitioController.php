<?php

namespace SM\Bundle\SitioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SitioController extends Controller
{
    public function indexAction()
    {
        return $this->render('SMSitioBundle:Sitio:index.html.twig');
    }

    public function newAction()
    {
    	return $this->render('SMSitioBundle:Sitio:index.html.twig');
    }
}
