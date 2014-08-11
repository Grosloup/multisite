<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/08/2014
 * Time: 16:35
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

namespace ZPB\Admin\SponsorshipBundle\Controller;


use ZPB\Admin\CommonBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function sidebarAction($active)
    {
        return $this->render('ZPBAdminSponsorshipBundle:Navs:sidebar.html.twig');
    }
}
