<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 07/08/14
 * Time: 14:32
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
use ZPB\Admin\MediatekBundle\Entity\Tag;
use ZPB\Admin\MediatekBundle\Form\Type\TagType;

class TagController extends BaseController
{
    public function indexAction()
    {
        $tags = $this->getRepo('ZPBAdminMediatekBundle:Tag')->findAllAlphaOrdered();
        return $this->render('ZPBAdminMediatekBundle:Tags:index.html.twig', ['tags'=>$tags]);
    }

    public function newAction(Request $request)
    {
        $tag = new Tag();

        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
            $this->successMessage('Nouveau mot-clé enregistré.');
            return $this->redirect($this->generateUrl('zpb_admin_mediatek_tag_homepage'));
        }
        return $this->render('ZPBAdminMediatekBundle:Tags:new.html.twig', ['form'=>$form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $tag = $this->getRepo("ZPBAdminMediatekBundle:Tag")->find($id);
        if(!$tag){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($tag);
            $em->flush();
            $this->successMessage("Le mot-clé ".$tag->getName()." a bien été mis à jour.");
            return $this->redirect($this->generateUrl("zpb_admin_mediatek_tag_homepage"));
        }
        return $this->render('ZPBAdminMediatekBundle:Tags:edit.html.twig', ['form' =>$form->createView(), "id"=>$id]);
    }

    public function deleteAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get("_token");
        if(!$token || !$csrfProv->isCsrfTokenValid("delete_tag",$token)){
            throw new AccessDeniedException();
        }
        $tag = $this->getRepo("ZPBAdminMediatekBundle:Tag")->find($id);
        if(!$tag){
            throw $this->createNotFoundException();
        }
        $em = $this->getEm();
        $em->remove($tag);
        $em->flush();
        $this->successMessage("Le mot-clé " . $tag->getName() . " a bien été supprimé.");
        return $this->redirect($this->generateUrl('zpb_admin_mediatek_tag_homepage'));
    }
} 
