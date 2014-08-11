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
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('email_edit',$token)){
            throw $this->createAccessDeniedException();
        }
        $email = $this->getRepo('ZPBAdminCommonBundle:Email')->find($id);
        if(!$email){
            throw $this->createNotFoundException();
        }
        //TODO
        return $this->render('ZPBAdminCommonBundle:Email:edit.html.twig');
    }

    public function userAddEmailAction($userid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_add_email',$token)){
            throw $this->createAccessDeniedException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            return $this->redirect($this->generateUrl(''));
            throw $this->createNotFoundException();
        }
        //TODO
        return $this->render('ZPBAdminCommonBundle:Email:new.html.twig');
    }

    public function userRemoveEmailAction($userid, $emailid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_remove_email',$token)){
            throw $this->createAccessDeniedException();
        }
        $email = $this->getRepo('ZPBAdminCommonBundle:Email')->find($emailid);
        if(!$email){
            throw $this->createNotFoundException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            throw $this->createNotFoundException();
        }
        //TODO
        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
    }

    public function userSetPrimaryEmailAction($userid, $emailid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_setprimary_email',$token)){
            throw $this->createAccessDeniedException();
        }
        $email = $this->getRepo('ZPBAdminCommonBundle:Email')->find($emailid);
        if(!$email){
            throw $this->createNotFoundException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            throw $this->createNotFoundException();
        }
        $this->getRepo('ZPBAdminCommonBundle:Email')->setDefault($email, $user);
        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
    }

    public function userUnsetPrimaryEmailAction($userid, $emailid, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_unsetprimary_email',$token)){
            throw $this->createAccessDeniedException();
        }
        $email = $this->getRepo('ZPBAdminCommonBundle:Email')->find($emailid);
        if(!$email){
            throw $this->createNotFoundException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($userid);
        if(!$user){
            throw $this->createNotFoundException();
        }
        $em = $this->getEm();
        $email->setIsDefault(false);
        $user->setPrimaryEmail(null);
        $em->persist($email);
        $em->persist($user);
        $em->flush();
        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
    }
}
