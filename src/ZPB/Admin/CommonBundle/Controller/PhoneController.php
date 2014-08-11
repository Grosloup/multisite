<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/08/2014
 * Time: 08:26
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

class PhoneController extends BaseController
{
    public function editAction($id, Request $request)
    {
        //TODO
    }

    public function userAddPhoneAction($userid, Request $request)
    {
        //TODO
    }

    public function userRemovePhoneAction($userid, $phoneid, Request $request)
    {
        //TODO
    }

    public function userSetPrimaryPhoneAction($userid, $phoneid, Request $request)
    {
        //TODO
    }

    public function userUnsetPrimaryPhoneAction($userid, $phoneid, Request $request)
    {
        //TODO
    }
}
