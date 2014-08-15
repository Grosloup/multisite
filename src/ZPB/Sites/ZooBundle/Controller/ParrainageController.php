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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContextInterface;
use ZPB\Admin\CommonBundle\Controller\BaseController;
use ZPB\Admin\SponsorshipBundle\Entity\Godparent;
use ZPB\Sites\ZooBundle\Form\Type\GodparentType;

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

    public function loginOrRegisterAction()
    {
        $user = $this->getUser();

        if($user && true === $this->get('security.context')->isGranted('ROLE_GODFATHER')){
            return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainage_payment_recap'));
        }
        $godparent = new Godparent();
        $form = $this->createForm(new GodparentType(), $godparent);

        return $this->render('ZPBSitesZooBundle:Parrainage/Payment:loginOrRegister.html.twig', ['form'=>$form->createView()]);
    }

    public function registerAction(Request $request)
    {
        $godparent = new Godparent();
        $plainPassword = $this->getRepo('ZPBAdminSponsorshipBundle:Godparent')->createPassword();
        $godparent->setPlainPassword($plainPassword);
        $godparent->setTmpPassword($plainPassword);
        $form = $this->createForm(new GodparentType(), $godparent);
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($godparent);
            $em->flush();
            $token = new UsernamePasswordToken($godparent,null,'sponsorship',$godparent->getRoles());
            $this->container->get('security.context')->setToken($token);
            return $this->redirect($this->generateUrl('zpb_sites_zoo_parrainage_payment_recap'));
        }

        return $this->render('ZPBSitesZooBundle:Parrainage/Payment:loginOrRegister.html.twig', ['form'=>$form->createView()]);
    }

    public function recapOrderAfterLoginAction(Request $request)
    {
        $user = $this->getUser();
        if(!$user || true !== $this->get('security.context')->isGranted('ROLE_GODFATHER')){
            throw $this->createAccessDeniedException();
        }
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
        return $this->render('ZPBSitesZooBundle:Parrainage/Payment:recapOrder.html.twig', ['packs'=>$items]);
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
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
        return $this->render('ZPBSitesZooBundle:Parrainage:Compte/login.html.twig', ['error'=>$error, 'last_username'=>$lastUsername]);
    }
}
