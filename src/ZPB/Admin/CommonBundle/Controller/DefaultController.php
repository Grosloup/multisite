<?php

namespace ZPB\Admin\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminCommonBundle:Default:index.html.twig');
    }
}
