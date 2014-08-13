<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/08/2014
 * Time: 18:10
 */
 /*
           ____________________
  __      /     ______         \
 {  \ ___/___ /       }         \
  {  /       / #      }          |
   {/ ô ô  ;       __}           |
   /          \__}    /  \       /\
<=(_    __<==/  |    /\___\     |  \
   (_ _(    |   |   |  |   |   /    #
    (_ (_   |   |   |  |   |   |
      (__<  |mm_|mm_|  |mm_|mm_|
*/

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Admin\CommonBundle\Controller\BaseController;

class ParrainageController extends BaseController
{
    public function indexAction()
    {
        $animals = $this->getRepo('ZPBAdminSponsorshipBundle:Animal')->findAll();
        return $this->render('ZPBSitesZooBundle:Parrainage:index.html.twig', ['animals'=>$animals]);
    }

    public function myAccountAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render('ZPBSitesZooBundle:Parrainage:Compte/myAccount.html.twig');
    }

    public function myAnimalsAction($canonic, Request $request)
    {
        $user = $this->getUser();
        return $this->render('ZPBSitesZooBundle:Parrainage:Compte/myAnimals.html.twig');
    }

    public function loginAction(Request $request)
    {
        return $this->render('ZPBSitesZooBundle:Parrainage:Compte/login.html.twig');
    }
}
