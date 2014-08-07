<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 03/08/2014
 * Time: 11:18
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


use ZPB\Admin\CommonBundle\Controller\BaseController;

class NavsController extends BaseController
{
    public function sidebarAction($active)
    {
        $numDraft = $this->getRepo('ZPBAdminBlogBundle:Article')->countDraft();
        $numPublished = $this->getRepo('ZPBAdminBlogBundle:Article')->countPublished();
        $numArchived = $this->getRepo('ZPBAdminBlogBundle:Article')->countArchived();
        $numDropped = $this->getRepo('ZPBAdminBlogBundle:Article')->countDropped();
        $numTags = $this->getRepo('ZPBAdminBlogBundle:Tag')->countTags();
        $numCats = $this->getRepo('ZPBAdminBlogBundle:Category')->countCategories();
        return $this->render("ZPBAdminBlogBundle:Navs:sidebar.html.twig",
            ["active" => $active, "pub"=>$numPublished, "draft"=>$numDraft, "arch"=>$numArchived, "drop"=>$numDropped, 'numTag'=>$numTags, 'numCat'=>$numCats]);
    }
}
