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
}
