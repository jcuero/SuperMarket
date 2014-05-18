<?php

namespace SM\Bundle\MarketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SMMarketBundle:Default:index.html.twig', array('name' => $name));
    }
}
