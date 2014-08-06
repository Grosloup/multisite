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
        $images = $this->getRepo('ZPBAdminMediatekBundle:Image')->findAll(); //TODO get alphaOrder
        //TODO pagination
        return $this->render('ZPBAdminMediatekBundle:Image:index.html.twig', ['images'=>$images]);
    }

    public function newAction(Request $request)
    {
        $image = new Image(
            $this->container->getParameter('mediatek_uploads_img_dir'),
            $this->container->getParameter('mediatek_uploads_img_thumbs_dir'),
            $this->container->getParameter('mediatek_root_dir')
        );
        $form = $this->createFormBuilder($image)
            ->add('name')
            ->add('file')
            ->add('save','submit')
            ->getForm();
        $form->handleRequest($request);
        if($form->isValid()){
            if($image->upload()){

                $em = $this->getEm();
                $em->persist($image);
                $em->flush();
                $resizer = $this->container->get('zpb.img_resizer');
                $resizer->resize($image);
                $this->successMessage("Votre image a bien été uploadée.");
                return $this->redirect($this->generateUrl('zpb_admin_mediatek_homepage'));
            }
            $this->errorMessage('Une erreur s\'est produite, votre image n\'a pas été traitée.');
            return $this->redirect($this->generateUrl('zpb_admin_mediatek_homepage'));
        }
        return $this->render('ZPBAdminMediatekBundle:Image:new.html.twig', ['form'=>$form->createView()]);
    }
}
