<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 06/08/14
 * Time: 14:46
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
use ZPB\Admin\MediatekBundle\Entity\Image;

class ImageController extends BaseController
{
    public function indexAction($page=1)
    {
        return $this->render('ZPBAdminMediatekBundle:Image:index.html.twig');
    }

    public function newAction(Request $request)
    {
        $image = new Image($this->container->getParameter('mediatek_uploads_img_dir'),$this->container->getParameter('mediatek_uploads_img_thumbs_dir'), $this->container->getParameter('mediatek_root_dir'));

        $form = $this->createFormBuilder($image)->add('name')->add('file')->add('save','submit')->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            if($image->upload()){
                $em = $this->getEm();
                $em->persist($image);
                $em->flush();
            }
            //TODO make thumb
            var_dump($image);
            die();
        }

        return $this->render('ZPBAdminMediatekBundle:Image:new.html.twig', ['form'=>$form->createView()]);
    }
} 
