<?php

namespace ZPB\Admin\BlogBundle\Controller;

use ZPB\Admin\CommonBundle\Controller\BaseController;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminBlogBundle:Default:index.html.twig');
    }
}
