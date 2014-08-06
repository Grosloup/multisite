<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 06/08/14
 * Time: 12:51
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

namespace ZPB\Admin\MediatekBundle\Controller;


use ZPB\Admin\CommonBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function sidebarAction($active)
    {
        return $this->render('ZPBAdminMediatekBundle:Navs:sidebar.html.twig', ['active'=>$active]);
    }
} 
