<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/08/14
 * Time: 12:29
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

namespace ZPB\Admin\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Admin\CommonBundle\Controller\BaseController;
use ZPB\Admin\ZooBundle\Entity\FImage;
use ZPB\Admin\ZooBundle\Form\Type\FImageType;

class FototekController extends BaseController
{
    public function indexAction()
    {

        //TODO alert no categorie, par defaut
        return $this->render('ZPBAdminZooBundle:Fototek:index.html.twig');
    }

    public function newImageAction(Request $request)
    {

        $image = new FImage(); //TODO set value for dirs...

        $form = $this->createForm(new FImageType(), $image, ['em'=>$this->getEm()]);

        return $this->render("ZPBAdminZooBundle:Fototek/FImage:new.html.twig", ['form'=>$form->createView()]);
    }
} 
