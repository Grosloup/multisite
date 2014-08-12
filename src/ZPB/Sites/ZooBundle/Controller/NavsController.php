<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 13/08/2014
 * Time: 01:37
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


use ZPB\Admin\CommonBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function commonbarAction()
    {

    }

    public function mainbarAction($active)
    {
        return $this->render('ZPBSitesZooBundle:Navs:mainbar.html.twig', ['active_section'=>$active]);
    }
}
