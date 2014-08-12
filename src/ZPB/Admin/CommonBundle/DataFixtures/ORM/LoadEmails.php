<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 12:28
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
use ZPB\Admin\CommonBundle\Entity\Email;

class LoadEmails extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    function load(ObjectManager $manager)
    {
        $email1 = new Email();
        $email1->setName('nico.canfrere@gmail.com');
        $email1->setIsDefault(false);
        $manager->persist($email1);

        $email2 = new Email();
        $email2->setName('nicolas.canfrere@zoobeauval.com');
        $email2->setIsDefault(true);
        $manager->persist($email2);

        $email3 = new Email();
        $email3->setName('fred.canfrere@gmail.com');
        $email3->setIsDefault(false);
        $manager->persist($email3);

        $email4 = new Email();
        $email4->setName('frederic.canfrere@zoobeauval.com');
        $email4->setIsDefault(true);
        $manager->persist($email4);

        $manager->flush();

        $this->addReference('email1', $email1);
        $this->addReference('email2', $email2);
        $this->addReference('email3', $email3);
        $this->addReference('email4', $email4);
    }

    public function getOrder()
    {
        return 21;
    }
}
