<?php

namespace ZPB\Admin\MediatekBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZPBAdminMediatekBundle:Default:index.html.twig');
    }
}
