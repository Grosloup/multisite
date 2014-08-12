<?php

namespace ZPB\Admin\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ZPB\Admin\CommonBundle\Entity\Email;
use ZPB\Admin\CommonBundle\Entity\User;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminCommonBundle:Default:index.html.twig');
    }
}
