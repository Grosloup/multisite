<?php

namespace ZPB\Sites\ZooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZPBSitesZooBundle:Default:index.html.twig');
    }
}
