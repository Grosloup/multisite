<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 03/08/2014
 * Time: 10:30
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

namespace ZPB\Admin\CommonBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavsController extends Controller
{
    public function topbarAction()
    {
        return $this->render("ZPBAdminCommonBundle:Navs:topbar.html.twig");
    }

    public function mainSidebarAction($active)
    {
        return $this->render("ZPBAdminCommonBundle:Navs:mainSidebar.html.twig", ["active" => $active]);
    }
}
