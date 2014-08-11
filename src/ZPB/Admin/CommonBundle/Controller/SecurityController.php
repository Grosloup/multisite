<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 09/08/2014
 * Time: 12:30
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
use Symfony\Component\Security\Core\SecurityContextInterface;
use ZPB\Admin\CommonBundle\Entity\User;
use ZPB\Admin\CommonBundle\Form\Type\UserType;

class SecurityController extends BaseController
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
        return $this->render('ZPBAdminCommonBundle:Security:login.html.twig', ['error'=>$error, 'last_username'=>$lastUsername]);
    }

    public function myAccountAction($canonic)
    {
        //TODO formulaire
        $activeUser = $this->getUser();
        if(!$activeUser || $activeUser->getCanonicalName() != $canonic){
            throw $this->createAccessDeniedException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->findOneByCanonicalName($canonic);
        if(!$user){
            throw $this->createNotFoundException();
        }
        return $this->render('ZPBAdminCommonBundle:Security:my_account.html.twig', ['userdata'=>$user]);
    }

    public function listUsersAction()
    {
        $users = $this->getRepo('ZPBAdminCommonBundle:User')->findAllAlphaOrdered();
        return $this->render('ZPBAdminCommonBundle:Security/Users:list.html.twig', ['users'=>$users]);
    }


    public function newUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);
        if($form->isValid()){
            //var_dump($form->getData());die();

            $em = $this->getEm();
            $countEmail = count($user->getEmails());
            foreach($user->getEmails() as $email){
                $email->setUser($user);
                if($countEmail === 1){
                    $email->setIsDefault(true);
                    $user->setPrimaryEmail($email);
                }
                $em->persist($email);
            }
            $countPhone = count($user->getPhones());
            foreach($user->getPhones() as $phone){
                $phone->setUser($user);
                if($countPhone === 1){
                    $phone->setIsDefault(true);
                    $user->setPrimaryPhone($phone);
                }
                $em->persist($phone);
            }
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
        }
        return $this->render('ZPBAdminCommonBundle:Security/Users:new.html.twig', ['form'=>$form->createView(), 'user'=>$user]);
    }

    public function editUserAction($id,Request $request)
    {
        //TODO
        return $this->render('ZPBAdminCommonBundle:Security/Users:edit.html.twig');
    }

    public function deleteUserAction($id,Request $request)
    {
        //TODO
    }

    public function lockUserAction($id,Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_lock', $token)){
            throw $this->createAccessDeniedException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($id);
        if(!$user){
            throw $this->createNotFoundException();
        }
        $user->setIsActive(false);
        $em = $this->getEm();
        $em->persist($user);
        $em->flush();
        $this->successMessage('L\'utilisateur est maintenant bloqué.');
        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
    }

    public function unlockUserAction($id,Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('user_unlock', $token)){
            throw $this->createAccessDeniedException();
        }
        $user = $this->getRepo('ZPBAdminCommonBundle:User')->find($id);
        if(!$user){
            throw $this->createNotFoundException();
        }
        $user->setIsActive(true);
        $em = $this->getEm();
        $em->persist($user);
        $em->flush();
        $this->successMessage('L\'utilisateur est maintenant débloqué.');
        return $this->redirect($this->generateUrl('zpb_admin_common_security_user_list'));
    }
}
