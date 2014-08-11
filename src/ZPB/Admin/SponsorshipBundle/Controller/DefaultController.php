<?php

namespace ZPB\Admin\SponsorshipBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZPBAdminSponsorshipBundle:Default:index.html.twig');
    }
}
