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

        }

        return $this->render('ZPBAdminCommonBundle:Security/Users:new.html.twig', ['form'=>$form->createView()]);
    }

    public function editUserAction($id,Request $request)
    {
        return $this->render('ZPBAdminCommonBundle:Security/Users:edit.html.twig');
    }

    public function deleteUserAction($id,Request $request)
    {

    }

    public function lockUserAction($id,Request $request)
    {

    }
}
