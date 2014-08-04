<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 03/08/2014
 * Time: 22:10
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

namespace ZPB\Admin\BlogBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ZPB\Admin\BlogBundle\Entity\Tag;
use ZPB\Admin\BlogBundle\Form\Type\TagType;
use ZPB\Admin\CommonBundle\Controller\BaseController;

class TagController extends BaseController
{
    public function indexAction()
    {
        $tags = $this->getRepo('ZPBAdminBlogBundle:Tag')->findAllAlphaOrdered();
        return $this->render('ZPBAdminBlogBundle:Tag:index.html.twig', ['tags'=>$tags]);
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
            return $this->redirect($this->generateUrl('zpb_admin_blog_tag_homepage'));
        }
        return $this->render('ZPBAdminBlogBundle:Tag:new.html.twig', ['form'=>$form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $tag = $this->getRepo("ZPBAdminBlogBundle:Tag")->find($id);
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
            return $this->redirect($this->generateUrl("zpb_admin_blog_tag_homepage"));
        }
        return $this->render("ZPBAdminBlogBundle:Tag:edit.html.twig", ['form' =>$form->createView(), "id"=>$id]);
    }

    public function deleteAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get("_token");
        if(!$token || !$csrfProv->isCsrfTokenValid("delete_tag",$token)){
            throw new AccessDeniedException();
        }
        $tag = $this->getRepo("ZPBAdminBlogBundle:Tag")->find($id);
        if(!$tag){
            throw $this->createNotFoundException();
        }
        $em = $this->getEm();
        $em->remove($tag);
        $em->flush();
        $this->successMessage("Le mot-clé " . $tag->getName() . " a bien été supprimé.");
        return $this->redirect($this->generateUrl("zpb_admin_blog_tag_homepage"));
    }
}
