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
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ZPB\Admin\CommonBundle\Controller\BaseController;
use ZPB\Admin\MediatekBundle\Entity\Image;
use ZPB\Admin\MediatekBundle\Form\Type\SimpleTagType;

class ImageController extends BaseController
{
    public function indexAction($page=1)
    {
        $images = $this->getRepo('ZPBAdminMediatekBundle:Image')->getAllImageAlphaOrdered($page, 10);
        $maxPage = $this->getRepo('ZPBAdminMediatekBundle:Image')->getNumPage(10);
        return $this->render('ZPBAdminMediatekBundle:Image:index.html.twig', ['images'=>$images, 'currentPage'=>$page, 'maxPage'=>$maxPage]);
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
            ->add('copyright')
            ->add('title',null,['label'=>'Attr. title'])
            ->add('file')
            ->add('tags', 'collection', ['label'=>'Mots-clés','type'=>new SimpleTagType(),'allow_add'=>true, 'by_reference'=>false])
            ->add('isArticleThumbnail',null, ['label'=>'Illustration d\'article ?'])
            ->add('save','submit')
            ->getForm();
        $form->handleRequest($request);
        if($form->isValid()){


            if($image->upload()){
                $em = $this->getEm();

                $tags = $image->getTags();
                foreach($tags as $tag){
                    $test = $this->getRepo('ZPBAdminMediatekBundle:Tag')->findOneByName($tag->getName());
                    if($test){
                        $image->removeTag($tag);
                        $image->addTag($test);
                        $test->addImage($image);
                        $em->persist($test);
                    } else {
                        $tag->addImage($image);
                        $em->persist($tag);
                    }
                }

                $em->persist($image);
                $em->flush();
                $resizer = $this->container->get('zpb.img_resizer');
                $resizer->resize($image);
                $this->successMessage('Votre image a bien été uploadée.');
                return $this->redirect($this->generateUrl('zpb_admin_mediatek_homepage'));
            }
            $this->errorMessage('Une erreur s\'est produite, votre image n\'a pas été traitée.');
            return $this->redirect($this->generateUrl('zpb_admin_mediatek_homepage'));
        }
        return $this->render('ZPBAdminMediatekBundle:Image:new.html.twig', ['form'=>$form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('image_edit',$token)){
            throw new AccessDeniedException();
        }
        $image = $this->getRepo('ZPBAdminMediatekBundle:Image')->find($id);
        if(!$image){
            throw $this->createNotFoundException();
        }
        $form = $this->createFormBuilder($image)
            ->add('name')
            ->add('title',null,['label'=>'Attr. title'])
            ->add('copyright')
            ->add('tags', 'collection', ['label'=>'Mots-clés','type'=>new SimpleTagType(),'allow_add'=>true, 'by_reference'=>false])
            ->add('isArticleThumbnail',null, ['label'=>'Illustration d\'article ?'])
            ->add('save','submit')
            ->getForm();
        ;
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $tags = $image->getTags();
            foreach($tags as $tag){
                $test = $this->getRepo('ZPBAdminMediatekBundle:Tag')->findOneByName($tag->getName());
                if($test){
                    $image->removeTag($tag);
                    $image->addTag($test);
                    $test->addImage($image);
                    $em->persist($test);
                } else {
                    $tag->addImage($image);
                    $em->persist($tag);
                }
            }
            $em->persist($image);
            $em->flush();
            $this->successMessage('Votre image a bien été mise à jour.');
            return $this->redirect($this->generateUrl('zpb_admin_mediatek_homepage'));
        }
        return $this->render('ZPBAdminMediatekBundle:Image:edit.html.twig', ['form'=>$form->createView(), 'image'=>$image]);
    }

    public function deleteAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('image_delete',$token)){
            throw new AccessDeniedException();
        }
        $image = $this->getRepo('ZPBAdminMediatekBundle:Image')->find($id);
        if(!$image){
            throw $this->createNotFoundException();
        }


        $em = $this->getEm();
        $em->remove($image);
        $em->flush();


        $this->successMessage('Votre image a bien été supprimée.');
        return $this->redirect($this->generateUrl('zpb_admin_mediatek_homepage'));
    }
}
