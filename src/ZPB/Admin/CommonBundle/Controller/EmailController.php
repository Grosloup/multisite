<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/08/2014
 * Time: 08:30
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


use Symfony\Component\HttpFoundation\Request;

class EmailController extends BaseController
{
    public function editAction($id, Request $request)
    {
        //TODO
    }

    public function userAddEmailAction($userid, Request $request)
    {
        //TODO
    }

    public function userRemoveEmailAction($userid, $emailid, Request $request)
    {
        //TODO
    }

    public function userSetPrimaryEmailAction($userid, $emailid, Request $request)
    {
        //TODO
    }

    public function userUnsetPrimaryEmailAction($userid, $emailid, Request $request)
    {
        //TODO
    }
}
