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
            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            $this->successMessage("Nouvelle catégorie enregistrée.");
            return $this->redirect($this->generateUrl("zpb_admin_blog_category_homepage"));
        }

        return $this->render("ZPBAdminBlogBundle:Category:new.html.twig", ['form' =>$form->createView()]);
    }
}
