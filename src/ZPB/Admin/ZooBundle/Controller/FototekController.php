<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/08/14
 * Time: 12:29
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

namespace ZPB\Admin\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Admin\CommonBundle\Controller\BaseController;
use ZPB\Admin\ZooBundle\Entity\FCategory;
use ZPB\Admin\ZooBundle\Entity\FImage;
use ZPB\Admin\ZooBundle\Form\Type\FCategoryType;
use ZPB\Admin\ZooBundle\Form\Type\FImageType;

class FototekController extends BaseController
{//TODO visualisation des images par categorie, simulateur de position
    public function indexAction($page = 1)
    {
        //TODO pagination
        $cats = $this->getRepo('ZPBAdminZooBundle:FCategory')->countCategories();
        $images = $this->getRepo('ZPBAdminZooBundle:FImage')->findAllAlphaOrdered();
        return $this->render('ZPBAdminZooBundle:Fototek:index.html.twig',['numCats'=>$cats, 'images'=>$images]);
    }

    public function newImageAction(Request $request)
    {
        $cats = $this->getRepo('ZPBAdminZooBundle:FCategory')->countCategories();
        if($cats < 1){
            return $this->redirect($this->generateUrl('zpb_admin_zoo_fototek_homepage'));
        }
        $image = new FImage(); //TODO set value for dirs...

        $form = $this->createForm(new FImageType(), $image, ['em'=>$this->getEm()]);

        return $this->render('ZPBAdminZooBundle:Fototek/FImage:new.html.twig', ['form'=>$form->createView()]);
    }


    public function listeCategoriesAction()
    {
        $categories = $this->getRepo('ZPBAdminZooBundle:FCategory')->findAll();
        $defaultCat = $this->getRepo('ZPBAdminZooBundle:FCategory')->findOneByIsDefault(true);
        return $this->render('ZPBAdminZooBundle:Fototek/FCategory:listeCategories.html.twig',
            ['categories'=>$categories, 'defaultCat'=>$defaultCat]);
    }

    public function newCategoriesAction(Request $request)
    {
        $category = new FCategory();
        $form = $this->createForm(new FCategoryType(), $category);

        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($category);
            $em->flush();
            $this->successMessage('La catégorie ' . $category->getName() . ' a bien été enregistrée.');
            return $this->redirect($this->generateUrl('zpb_admin_zoo_fototek_categories_homepage'));
        }
        return $this->render('ZPBAdminZooBundle:Fototek/FCategory:newCategories.html.twig', ['form'=>$form->createView()]);
    }

    public function editCategoriesAction($id,Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('category_edit', $token)){
            throw $this->createAccessDeniedException();
        }
        $category = $this->getRepo('ZPBAdminZooBundle:FCategory')->find($id);
        if(!$category){
            throw $this->createNotFoundException();
        }
        $form = $this->createForm(new FCategoryType(), $category);

        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($category);
            $em->flush();
            $this->successMessage('La catégorie ' . $category->getName() . ' a bien été mise à jour.');
            return $this->redirect($this->generateUrl('zpb_admin_zoo_fototek_categories_homepage'));
        }
        $defaultCat = $this->getRepo('ZPBAdminZooBundle:FCategory')->findOneByIsDefault(true);
        return $this->render('ZPBAdminZooBundle:Fototek/FCategory:editCategories.html.twig',
            ['defaultCat'=>$defaultCat,'form'=>$form->createView()]);
    }

    public function deleteCategoriesAction($id,Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('category_delete', $token)){
            throw $this->createAccessDeniedException();
        }
        $category = $this->getRepo('ZPBAdminZooBundle:FCategory')->find($id);
        if(!$category){
            throw $this->createNotFoundException();
        }
        $em = $this->getEm();
        $em->remove($category);
        $em->flush();
        $this->successMessage('La catégorie ' . $category->getName() . ' a bien été supprimée.');
        return $this->redirect($this->generateUrl('zpb_admin_zoo_fototek_categories_homepage'));
    }
}
