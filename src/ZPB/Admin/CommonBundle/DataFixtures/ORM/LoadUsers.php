<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 12:14
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

namespace ZPB\Admin\CommonBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\Admin\CommonBundle\Entity\User;

class LoadUsers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    function load(ObjectManager $manager)
    {

        $user1 = new User();
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user1);
        $encodedPassword = $encoder->encodePassword('superadminpass', $user1->getSalt());
        $user1->setPassword($encodedPassword);
        $user1->setUsername('superadmin');
        $user1->setFirstname('Nicolas');
        $user1->setLastname('Canfrère');
        $user1->setRoles(['ROLE_SUPERADMIN']);
        $user1->setIsActive(true);
        $user1->addPhone($this->getReference('phone1'));
        $this->getReference('phone1')->setUser($user1);
        $user1->addPhone($this->getReference('phone2'));
        $this->getReference('phone2')->setUser($user1);
        $user1->addEmail($this->getReference('email1'));
        $this->getReference('email1')->setUser($user1);
        $user1->addEmail($this->getReference('email2'));
        $this->getReference('email2')->setUser($user1);
        $manager->persist($this->getReference('phone1'));
        $manager->persist($this->getReference('phone2'));
        $manager->persist($this->getReference('email1'));
        $manager->persist($this->getReference('email2'));
        $manager->persist($user1);

        $user2 = new User();
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user2);
        $encodedPassword = $encoder->encodePassword('adminpass', $user2->getSalt());
        $user2->setPassword($encodedPassword);
        $user2->setUsername('admin');
        $user2->setFirstname('Frédéric');
        $user2->setLastname('Canfrère');
        $user2->setRoles(['ROLE_ADMIN']);
        $user2->setIsActive(true);
        $user2->addPhone($this->getReference('phone3'));
        $this->getReference('phone3')->setUser($user2);
        $user2->addPhone($this->getReference('phone4'));
        $this->getReference('phone4')->setUser($user2);
        $user2->addEmail($this->getReference('email3'));
        $this->getReference('email3')->setUser($user2);
        $user2->addEmail($this->getReference('email4'));
        $this->getReference('email4')->setUser($user2);
        $manager->persist($this->getReference('phone3'));
        $manager->persist($this->getReference('phone4'));
        $manager->persist($this->getReference('email3'));
        $manager->persist($this->getReference('email4'));
        $manager->persist($user2);

        $manager->flush();

    }

    public function getOrder()
    {
        return 22;
    }
}
