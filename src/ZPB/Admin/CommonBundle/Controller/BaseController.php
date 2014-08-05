<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 03/08/2014
 * Time: 21:44
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


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{

    public function getRepo($repo)
    {
        return $this->getDoctrine()->getRepository($repo);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    public function successMessage($message = "")
    {
        if(!$message || !$this->container->has('session')){
            return;
        }
        $this->get('session')->getFlashBag()->add('success', $message);
    }

    public function warningMessage($message = "")
    {
        if(!$message || !$this->container->has('session')){
            return;
        }
        $this->get('session')->getFlashBag()->add('warning', $message);
    }

    public function errorMessage($message = "")
    {
        if(!$message || !$this->container->has('session')){
            return;
        }
        $this->get('session')->getFlashBag()->add('error', $message);
    }

    public function infoMessage($message = "")
    {
        if(!$message || !$this->container->has('session')){
            return;
        }
        $this->get('session')->getFlashBag()->add('info', $message);
    }

    public function getCsrfProvider()
    {
        return $this->container->get("form.csrf_provider");
    }
}
