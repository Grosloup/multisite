<?php

namespace ZPB\Admin\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ZPB\Admin\CommonBundle\Entity\Email;
use ZPB\Admin\CommonBundle\Entity\User;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        /*$user = new User();
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
        $encodedPassword = $encoder->encodePassword("adminpass", $user->getSalt());
        $user->setUsername("admin");
        $user->setPassword($encodedPassword);
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setIsActive(true);
        $em = $this->getEm();
        $email1 = new Email();
        $email1->setName('nico.canfrere@gmail.com');
        $email1->setUser($user);
        $email1->setIsDefault(true);
        $em->persist($email1);
        $email2 = new Email();
        $email2->setName('canfrere.nicolas@orange.fr');
        $email2->setUser($user);
        $em->persist($email2);

        $user->addEmail($email1);
        $em->persist($user);
        $em->flush();*/

        return $this->render('ZPBAdminCommonBundle:Default:index.html.twig');
    }
}
