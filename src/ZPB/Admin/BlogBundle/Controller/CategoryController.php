<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 03/08/2014
 * Time: 20:05
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
use ZPB\Admin\BlogBundle\Entity\Category;
use ZPB\Admin\BlogBundle\Form\Type\CategoryType;
use ZPB\Admin\CommonBundle\Controller\BaseController;

class CategoryController extends BaseController
{
    public function indexAction()
    {
        $cats = $this->getRepo("ZPBAdminBlogBundle:Category")->findAllAlphaOrdered();
        return $this->render("ZPBAdminBlogBundle:Category:index.html.twig", ["categories"=>$cats]);
    }

    public function newAction(Request $request)
    {
        $cat = new Category();
        $form = $this->createForm(new CategoryType(), $cat);
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($cat);
            $em->flush();
            $this->successMessage("Nouvelle catégorie enregistrée.");
            return $this->redirect($this->generateUrl("zpb_admin_blog_category_homepage"));
        }
        return $this->render("ZPBAdminBlogBundle:Category:new.html.twig", ['form' =>$form->createView()]);
    }

    public function editAction($id, Request $request)
    {
        $cat = $this->getRepo("ZPBAdminBlogBundle:Category")->find($id);
        if(!$cat){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new CategoryType(), $cat);
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($cat);
            $em->flush();
            $this->successMessage("La catégorie ".$cat->getName()." a bien été mise à jour.");
            return $this->redirect($this->generateUrl("zpb_admin_blog_category_homepage"));
        }
        return $this->render("ZPBAdminBlogBundle:Category:edit.html.twig", ['form' =>$form->createView(), "id"=>$id]);
    }


    public function deleteAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get("_token");
        if(!$token || !$csrfProv->isCsrfTokenValid("delete_category",$token)){
            throw new AccessDeniedException();
        }
        $cat = $this->getRepo("ZPBAdminBlogBundle:Category")->find($id);
        if(!$cat){
            throw $this->createNotFoundException();
        }
        $em = $this->getEm();
        $em->remove($cat);
        $em->flush();
        $this->successMessage("La catégorie " . $cat->getName() . " a bien été supprimée.");
        return $this->redirect($this->generateUrl("zpb_admin_blog_category_homepage"));
    }
}
