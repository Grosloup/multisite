<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/08/14
 * Time: 12:29
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

class FototekController extends BaseController
{
    public function indexAction()
    {
        return $this->render('ZPBAdminZooBundle:Fototek:index.html.twig');
    }
} 
