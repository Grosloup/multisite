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
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('phone_edit',$token)){
            throw $this->createAccessDeniedException();
        }
        $phone = $this->getRepo('ZPBAdminCommonBundle:PhoneNumber')->find($id);
        if(!$phone){
            throw $this->createNotFoundException();
        }


        //TODO
        return $this->render('ZPBAdminCommonBundle:Phone:edit.html.twig');
    }

    public function userAddPhoneAction($userid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_add_phone',$token)){
            throw $this->createAccessDeniedException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            throw $this->createNotFoundException();
        }
        //TODO
        return $this->render('ZPBAdminCommonBundle:Phone:new.html.twig');
    }

    public function userRemovePhoneAction($userid, $phoneid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_remove_phone',$token)){
            throw $this->createAccessDeniedException();
        }
        $phone = $this->getRepo('ZPBAdminCommonBundle:PhoneNumber')->find($phoneid);
        if(!$phone){
            throw $this->createNotFoundException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            throw $this->createNotFoundException();
        }
        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
        //TODO
    }

    public function userSetPrimaryPhoneAction($userid, $phoneid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_setprimary_phone',$token)){
            throw $this->createAccessDeniedException();
        }
        $phone = $this->getRepo('ZPBAdminCommonBundle:PhoneNumber')->find($phoneid);
        if(!$phone){
            throw $this->createNotFoundException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            throw $this->createNotFoundException();
        }
        $this->getRepo('ZPBAdminCommonBundle:PhoneNumber')->setDefault($phone, $user);

        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
    }

    public function userUnsetPrimaryPhoneAction($userid, $phoneid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_unsetprimary_phone',$token)){
            throw $this->createAccessDeniedException();
        }
        $phone = $this->getRepo('ZPBAdminCommonBundle:PhoneNumber')->find($phoneid);
        if(!$phone){
            throw $this->createNotFoundException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            throw $this->createNotFoundException();
        }
        $em = $this->getEm();
        $phone->setIsDefault(false);
        $user->setPrimaryPhone(null);
        $em->persist($phone);
        $em->persist($user);
        $em->flush();
        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
    }
}
