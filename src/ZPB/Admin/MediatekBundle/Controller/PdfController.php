<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/08/14
 * Time: 10:48
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


use Symfony\Component\HttpFoundation\Request;
use ZPB\Admin\CommonBundle\Controller\BaseController;

class PdfController extends BaseController
{
    public function indexAction($page=1)
    {
        return $this->render('ZPBAdminMediatekBundle:Pdf:index.html.twig', ['currentPage'=>$page]);
    }

    public function newAction(Request $request)
    {

    }

    public function editAction($id, Request $request)
    {

    }

    public function deleteAction($id, Request $request)
    {

    }
} 
