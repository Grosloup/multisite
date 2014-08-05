<?php

namespace ZPB\Admin\BlogBundle\Controller;

use ZPB\Admin\CommonBundle\Controller\BaseController;

class DefaultController extends BaseController
{
    public function indexAction($page = 1)
    {
        $pubArts = [];
        $draftArts = [];
        $tags = [];
        $frontZoo = null;
        $frontBn = null;
        $maxPage = 0;
        $cats = $this->getRepo('ZPBAdminBlogBundle:Category')->findAllAlphaOrdered();
        $numDraft = $numPublished = $numArchived =0;
        if($cats){
            $maxPage = $this->getRepo('ZPBAdminBlogBundle:Article')->getNumPageForPublishedByDate(10);
            $draftArts = $this->getRepo('ZPBAdminBlogBundle:Article')->getAllDraftOrderedByDate();
            $pubArts = $this->getRepo('ZPBAdminBlogBundle:Article')->getAllPublishedOrderedByDate($page,10,$maxPage);
            $frontZoo = $this->getRepo('ZPBAdminBlogBundle:Article')->findOneByIsFrontZoo(true);
            $frontBn = $this->getRepo('ZPBAdminBlogBundle:Article')->findOneByIsFrontBn(true);
            $tags = $this->getRepo('ZPBAdminBlogBundle:Tag')->findAllAlphaOrdered();
            $numDraft = $this->getRepo('ZPBAdminBlogBundle:Article')->countDraft();
            $numPublished = $this->getRepo('ZPBAdminBlogBundle:Article')->countPublished();
        }
        return $this->render('ZPBAdminBlogBundle:Default:index.html.twig', [
            'drafts' => $draftArts,
            'published' => $pubArts,
            'categories' => $cats,
            'alaunezoo'=> $frontZoo,
            'alaunebn'=> $frontBn,
            'tags'=>$tags,
            'currentPage'=>$page,
            'maxPage'=>$maxPage,
            'numDraft'=>$numDraft,
            'numPub'=>$numPublished,
        ]);
    }
}
