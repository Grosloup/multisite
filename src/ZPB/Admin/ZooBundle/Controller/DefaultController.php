<?php

namespace ZPB\Admin\ZooBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZPBAdminZooBundle:Default:index.html.twig');
    }
}
