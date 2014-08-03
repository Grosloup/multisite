<?php

namespace ZPB\Admin\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZPBAdminBlogBundle:Default:index.html.twig');
    }
}
