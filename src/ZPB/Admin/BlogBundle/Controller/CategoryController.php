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
        $defaultCat = $this->getRepo('ZPBAdminBlogBundle:Category')->findOneByIsDefault(true);
        return $this->render("ZPBAdminBlogBundle:Category:index.html.twig", ["categories"=>$cats, "defaultCat"=>$defaultCat]);
    }

    public function newAction(Request $request)
    {
        $cat = new Category();
        $cat->setIsDefault(false);
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
        $token = $request->query->get('_token');
        if(!$token || !$csrfProv->isCsrfTokenValid('delete_category',$token)){
            throw new AccessDeniedException();
        }
        $cat = $this->getRepo('ZPBAdminBlogBundle:Category')->find($id);
        if(!$cat){
            throw $this->createNotFoundException();
        }
        if($cat->getIsDefault()){
            $this->warningMessage('Vous devez définir une autre catégorie par défaut pour pouvoir supprimer l\'actuelle.');
            return $this->redirect($this->generateUrl('zpb_admin_blog_category_homepage'));
        }
        $defaultCat = $this->getRepo('ZPBAdminBlogBundle:Category')->findOneByIsDefault(true);
        if(!$defaultCat){
            throw new AccessDeniedException();
        }
        $articles = $this->getRepo('ZPBAdminBlogBundle:Article')->getAllByCategoryId($id);

        $em = $this->getEm();
        if(count($articles)){
            foreach($articles as $art){
                $art->setCategory($defaultCat);
                $em->persist($art);
            }
        }
        $em->remove($cat);
        $em->flush();
        $this->successMessage('La catégorie ' . $cat->getName() . ' a bien été supprimée.');
        return $this->redirect($this->generateUrl('zpb_admin_blog_category_homepage'));
    }

    public function setDefaultAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get("_token");
        if(!$token || !$csrfProv->isCsrfTokenValid("category_setDefault",$token)){
            throw new AccessDeniedException();
        }
        $cat = $this->getRepo("ZPBAdminBlogBundle:Category")->find($id);
        if(!$cat){
            throw $this->createNotFoundException();
        }
        $default = $this->getRepo('ZPBAdminBlogBundle:Category')->findOneByIsDefault(true);
        $em = $this->getEm();
        if($default){
            $default->setIsDefault(false);
            $em->persist($default);
        }
        $cat->setIsDefault(true);
        $em->persist($cat);
        $em->flush();
        $this->successMessage("La catégorie " . $cat->getName() . " est maintenat la catégorie par défaut.");
        return $this->redirect($this->generateUrl("zpb_admin_blog_category_homepage"));
    }
}
