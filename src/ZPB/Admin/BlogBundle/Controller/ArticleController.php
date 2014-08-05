<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 03/08/2014
 * Time: 11:26
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
use ZPB\Admin\BlogBundle\Entity\Article;
use ZPB\Admin\BlogBundle\Form\Type\ArticleType;
use ZPB\Admin\CommonBundle\Controller\BaseController;

class ArticleController extends BaseController
{
    public function newAction(Request $request)
    {
        $cats = $this->getRepo("ZPBAdminBlogBundle:Category")->findAllAlphaOrdered();
        if(!$cats){
            //TODO
        }
        $article = new Article();
        $form = $this->createForm(new ArticleType(), $article);

        $form->handleRequest($request);

        if($form->isValid()){
            $tags = $article->getTags();
            $em = $this->getEm();
            foreach($tags as $tag){
                $test = $this->getRepo("ZPBAdminBlogBundle:Tag")->findOneByName($tag->getName());
                if($test){
                    $article->removeTag($tag);
                    $article->addTag($test);
                    $test->addArticle($article);
                    $em->persist($test);
                } else {
                    $tag->addArticle($article);
                    $em->persist($tag);
                }


            }

            $pubAction = $form->get('savePublish')->isClicked();
            if($pubAction){
                $article->setIsDraft(false)->setIsPublished(true);
            }

            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('zpb_admin_blog_homepage'));
        }

        return $this->render("ZPBAdminBlogBundle:Article:new.html.twig", ['categories'=>$cats, 'form'=>$form->createView(), 'article'=>$article]);
    }

    public function setPublishedAction($id, Request $request)
    {
        $csrfPro = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfPro->isCsrfTokenValid('publish_article', $token)){
            throw new AccessDeniedException('token invalid ou absent');
        }
        /** @var \ZPB\Admin\BlogBundle\Entity\Article $art */
        $art = $this->getRepo('ZPBAdminBlogBundle:Article')->find($id);
        if(!$art){
            throw $this->createNotFoundException();
        }
        $em = $this->getEm();
        $art->setIsDraft(false)->setIsPublished(true);
        $em->persist($art);
        $em->flush();
        $this->successMessage('Votre article ('.$art->getLongId().') est publié.');
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function setFrontZooAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_setFrontZoo');
        $frontZoo = $this->getRepo('ZPBAdminBlogBundle:Article')->getALaUneZoo();
        $em = $this->getEm();
        if($frontZoo){
            $frontZoo->setIsFrontZoo(false);
            $em->persist($frontZoo);
        }
        $art->setIsFrontZoo(true);
        $em->persist($art);
        $em->flush();
        $this->successMessage('Votre article ('.$art->getLongId().') est à la une du zoo.');
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function unsetFrontZooAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_unsetFrontZoo');
        if($art->getIsFrontZoo()){
            $em = $this->getEm();
            $art->setIsFrontZoo(false);
            $em->persist($art);
            $em->flush();
            $this->successMessage('Votre article ('.$art->getLongId().') n\'est plus à la une du zoo.');
        }
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function setFrontBnAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_setFrontBn');
        $frontBn = $this->getRepo('ZPBAdminBlogBundle:Article')->getALaUneBn();
        $em = $this->getEm();
        if($frontBn){
            $frontBn->setIsFrontBn(false);
            $em->persist($frontBn);
        }
        $art->setIsFrontBn(true);
        $em->persist($art);
        $em->flush();
        $this->successMessage('Votre article ('.$art->getLongId().') est à la une de B.Nature.');
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function unsetFrontBnAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_unsetFrontBn');
        if($art->getIsFrontBn()){
            $em = $this->getEm();
            $art->setIsFrontBn(false);
            $em->persist($art);
            $em->flush();
            $this->successMessage('Votre article ('.$art->getLongId().') n\'est plus à la une de B.Nature.');
        }
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    private function getSecureArticleById($id, $token=false, $intention='')
    {
        $art = null;
        $csrfPro = $this->getCsrfProvider();
        if(!$token || !$csrfPro->isCsrfTokenValid($intention, $token)){
            throw new AccessDeniedException('token invalid ou absent');
        }
        /** @var \ZPB\Admin\BlogBundle\Entity\Article $art */
        $art = $this->getRepo('ZPBAdminBlogBundle:Article')->find($id);
        if(!$art){
            throw $this->createNotFoundException();
        }
        return $art;
    }


}
