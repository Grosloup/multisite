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



class NavsController extends BaseController
{
    public function topbarAction()
    {
        return $this->render("ZPBAdminCommonBundle:Navs:topbar.html.twig");
    }

    public function mainSidebarAction($active)
    {
        return $this->render("ZPBAdminCommonBundle:Navs:mainSidebar.html.twig", ["active" => $active]);
    }

    public function usersSidebarAction($active)
    {
        $numUsers = $this->getRepo('ZPBAdminCommonBundle:User')->countUsers();
        return $this->render("ZPBAdminCommonBundle:Navs:usersSidebar.html.twig", ["active" => $active, 'numUsers'=>$numUsers]);
    }
}
