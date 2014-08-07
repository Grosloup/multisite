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
            $this->errorMessage("Avant de pouvoir écrire un article, vous devez définir au moins une catégorie.");
            return $this->redirect($this->generateUrl('zpb_admin_blog_homepage'));
        }
        $article = new Article();
        $imgs = $this->getRepo('ZPBAdminMediatekBundle:Image')->findByIsArticleThumbnail(true);
        $form = $this->createForm(new ArticleType(), $article, ['em'=>$this->getEm()]);
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
            $draftAction = $form->get('saveDraft')->isClicked();
            $pubAction = $form->get('savePublish')->isClicked();
            if($draftAction){
                $article->setIsDraft(true);
            }
            if($pubAction){
                $article->setIsDraft(false)->setIsPublished(true);
            }
            if($article->getIsFrontZoo()){
                $frontZoo = $this->getRepo('ZPBAdminBlogBundle:Article')->getALaUneZoo();
                if($frontZoo){
                    $frontZoo->setIsFrontZoo(false);
                    $em->persist($frontZoo);
                }
            }
            if($article->getIsFrontBn()){
                $frontBn = $this->getRepo('ZPBAdminBlogBundle:Article')->getALaUneBn();
                if($frontBn){
                    $frontBn->setIsFrontBn(false);
                    $em->persist($frontBn);
                }
            }
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('zpb_admin_blog_homepage'));
        }
        $tagsName = $this->getRepo('ZPBAdminBlogBundle:Tag')->findAllNamesAlphaOrdered();
        return $this->render("ZPBAdminBlogBundle:Article:new.html.twig", ['form'=>$form->createView(), 'article'=>$article, 'tags'=>$tagsName, 'imgs'=>$imgs]);
    }

    public function editAction($id, Request $request)
    {
        $article = $this->getRepo('ZPBAdminBlogBundle:Article')->find($id);
        if(!$article){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new ArticleType(), $article, ['em'=>$this->getEm()]);
        if(strtoupper($request->getMethod()) == "POST"){
            $article->removeTags();
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
                $draftAction = $form->get('saveDraft')->isClicked();
                $pubAction = $form->get('savePublish')->isClicked();
                if($draftAction){
                    $article->setIsDraft(true);
                }
                if($pubAction){
                    $article->setIsDraft(false)->setIsPublished(true);
                }
                if($article->getIsFrontZoo()){
                    $frontZoo = $this->getRepo('ZPBAdminBlogBundle:Article')->getALaUneZoo();
                    if($frontZoo && $frontZoo->getId() != $article->getId()){
                        $frontZoo->setIsFrontZoo(false);
                        $em->persist($frontZoo);
                    }
                }
                if($article->getIsFrontBn()){
                    $frontBn = $this->getRepo('ZPBAdminBlogBundle:Article')->getALaUneBn();

                    if($frontBn && $frontBn->getId() != $article->getId()){
                        $frontBn->setIsFrontBn(false);
                        $em->persist($frontBn);
                    }
                }
                $em->persist($article);
                $em->flush();
                return $this->redirect($this->generateUrl('zpb_admin_blog_homepage'));
            }
        }
        $tagsName = $this->getRepo('ZPBAdminBlogBundle:Tag')->findAllNamesAlphaOrdered();
        return $this->render('ZPBAdminBlogBundle:Article:edit.html.twig', ['tags'=>$tagsName, 'id'=>$id, 'form'=>$form->createView(), 'article'=>$article]);
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

    public function setArchivedAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_setArchived');
        $em = $this->getEm();
        $art->archive();
        $em->persist($art);
        $em->flush();
        $this->successMessage('Votre article ('.$art->getLongId().') fait maintenant partie des archives.');
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function unsetArchivedAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_unsetArchived');
        $em = $this->getEm();
        $art->unarchive();
        $em->persist($art);
        $em->flush();
        $this->successMessage('Votre article ('.$art->getLongId().') est maintenant remis en publication.');
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

    public function archivesAction($page = 1)
    {
        $maxPage = $this->getRepo("ZPBAdminBlogBundle:Article")->getNumPageForArchivedByDate(10);
        $archives = $this->getRepo("ZPBAdminBlogBundle:Article")->getAllArchivedOrderedByDate($page, 10, $maxPage);
        $numArchived = $this->getRepo('ZPBAdminBlogBundle:Article')->countArchived();
        return $this->render("ZPBAdminBlogBundle:Article:archives.html.twig",
            ['archives'=>$archives, 'maxPage'=>$maxPage, 'currentPage'=>$page, 'numArchives'=>$numArchived]);
    }

    public function dropAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_drop');
        $art->drop();
        $em = $this->getEm();
        $em->persist($art);
        $em->flush();
        //TODO referrer
        $this->successMessage('Votre article ('.$art->getLongId().') est mis à la corbeille.');
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function undropAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_undrop');
        $art->undrop();
        $em = $this->getEm();
        $em->persist($art);
        $em->flush();
        //TODO referrer
        $this->successMessage('Votre article ('.$art->getLongId().') est maintenant remis en publication.');
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function trashesAction($page = 1)
    {
        $maxPage = $this->getRepo('ZPBAdminBlogBundle:Article')->getNumPageForDroppedByDate(1);
        $dropped = $this->getRepo('ZPBAdminBlogBundle:Article')->getAllDroppedOrderedByDate($page, 1, $maxPage);
        $numDropped = $this->getRepo('ZPBAdminBlogBundle:Article')->countDropped();
        return $this->render("ZPBAdminBlogBundle:Article:trashes.html.twig",
            ['currentPage'=>$page, 'maxPage'=>$maxPage, 'trashes'=>$dropped, 'numDropped'=>$numDropped]);
    }

    public function deleteAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_delete');
        $em = $this->getEm();
        $em->remove($art);
        $em->flush();
        $this->successMessage('Votre article ('.$art->getLongId().') a bien été supprimé.');
        return $this->redirect($this->generateUrl("zpb_admin_blog_homepage"));
    }

    public function showAction($id, Request $request)
    {
        $token = $request->query->get('_token', false);
        $art = $this->getSecureArticleById($id, $token, 'article_show');

        return $this->render("ZPBAdminBlogBundle:Article:show.html.twig", ['article'=>$art]);
    }

    public function articlesByCategoryAction($catslug)
    {
        $cat = $this->getRepo('ZPBAdminBlogBundle:Category')->findOneBySlug($catslug);
        if(!$cat){
            throw $this->createNotFoundException();
        }
        $articles = $this->getRepo('ZPBAdminBlogBundle:Article')->getAllByCategorySlugAndOrderedByDate($catslug);
        return $this->render("ZPBAdminBlogBundle:Article:articles_by_category.html.twig", ['articles'=>$articles, 'cat_name'=>$cat->getName()]);
    }
}
