<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/08/14
 * Time: 17:18
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

namespace ZPB\Admin\ZooBundle\Controller;


use ZPB\Admin\CommonBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function fototekSidebarAction($active = "")
    {
        $numImage = 0; //TODO countImage
        $numCat = $this->getRepo("ZPBAdminZooBundle:FCategory")->countCategories();
        return $this->render('ZPBAdminZooBundle:Navs:fototek_sidebar.html.twig', ['active'=>$active, 'numImage'=>$numImage, 'numCat'=>$numCat]);
    }
}
