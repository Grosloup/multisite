<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 11/08/2014
 * Time: 18:10
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

namespace ZPB\Sites\ZooBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use ZPB\Admin\CommonBundle\Controller\BaseController;

class ParrainageController extends BaseController
{
    public function indexAction()
    {
        $animals = $this->getRepo('ZPBAdminSponsorshipBundle:Animal')->findAll();

        return $this->render('ZPBSitesZooBundle:Parrainage:index.html.twig', ['animals'=>$animals]);
    }

    public function showAnimalAction($name, Request $request)
    {
        $animal = $this->getRepo('ZPBAdminSponsorshipBundle:Animal')->findOneByCanonicalLongName($name);
        if(!$animal){
            throw $this->createNotFoundException();
        }
        $offers = $this->getRepo('ZPBAdminSponsorshipBundle:SponsorshipDesc')->findByIsCurrentOffer(true);
        $gifts  = $this->getRepo('ZPBAdminSponsorshipBundle:GiftDesc')->findAll();
        return $this->render('ZPBSitesZooBundle:Parrainage:showAnimal.html.twig', ['animal'=>$animal,'offers'=>$offers,'gifts'=>$gifts]);
    }

    public function addSponsorshipToBasketAction(Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $form = $request->request->get("sponsorship_form", false);
        if(!$form){
            throw $this->createAccessDeniedException();
        }
        $token = empty($form['_token']) ? false : $form['_token'];
        if(!$token || !$csrfProv->isCsrfTokenValid('add_sponsorship', $token)){
            throw $this->createAccessDeniedException();
        }
        $packId = empty($form['pack']) ? false : $form['pack'];
        $animalId = empty($form['animal']) ? false : $form['animal'];
        if(!$packId || !$animalId){
            throw $this->createAccessDeniedException();
        }
        $pack = $this->getRepo('ZPBAdminSponsorshipBundle:SponsorshipDesc')->find($packId);
        if(!$pack){
            throw $this->createNotFoundException();
        }
        $animal = $this->getRepo('ZPBAdminSponsorshipBundle:Animal')->find($animalId);
        if(!$animal){
            throw $this->createNotFoundException();
        }
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        $sb->addItem($pack, $animal);
        return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainage_show_basket'));
    }

    public function removeSponsorshipToBasketAction($id, Request $request)
    {
        $csrfProv = $this->getCsrfProvider();
        $token = $request->query->get('_token', false);
        if(!$token || !$csrfProv->isCsrfTokenValid('delete_from_basket',$token)){
            throw $this->createAccessDeniedException();
        }
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        $sb->removeItem($id);
        return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainage_show_basket'));
    }

    public function showSponsorshipToBasketAction(Request $request)
    {
        $sb = $this->container->get('zpb.zoo.sponsor_basket');
        $items = [];

        if(!$sb->isEmpty()){
            $em = $this->getEm();
            foreach($sb->getItems() as $k=>$v){
                $animalId = $v->getAnimal()->getId();
                $packId = $v->getPack()->getId();
                $animal = $em->find(get_class($v->getAnimal()),$animalId);
                $pack = $em->find(get_class($v->getPack()), $packId);
                $items[$v->getId()] = ["pack"=>$pack, "animal"=>$animal];
            }
        }


        return $this->render('ZPBSitesZooBundle:Parrainage:sponsorshipBasket.html.twig',['packs'=>$items]);

    }

    public function myAccountAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render('ZPBSitesZooBundle:Parrainage:Compte/myAccount.html.twig');
    }

    public function myAnimalsAction($canonic, Request $request)
    {
        $user = $this->getUser();
        return $this->render('ZPBSitesZooBundle:Parrainage:Compte/myAnimals.html.twig');
    }

    public function loginAction(Request $request)
    {
        return $this->render('ZPBSitesZooBundle:Parrainage:Compte/login.html.twig');
    }
}
