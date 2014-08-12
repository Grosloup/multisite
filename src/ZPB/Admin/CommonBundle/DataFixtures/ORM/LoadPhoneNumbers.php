<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 12:17
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
use ZPB\Admin\CommonBundle\Entity\PhoneNumber;

class LoadPhoneNumbers extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container=null)
    {
        $this->container = $container;
    }

    function load(ObjectManager $manager)
    {
        $phone1 = new PhoneNumber();
        $phone1->setNumber("11 11 11 11 11");
        $phone1->setType("mobile pro");
        $phone1->setIsDefault(true);
        $manager->persist($phone1);

        $phone2 = new PhoneNumber();
        $phone2->setNumber("22 22 22 22 22");
        $phone2->setType("mobile perso");
        $phone2->setIsDefault(false);
        $manager->persist($phone2);

        $phone3 = new PhoneNumber();
        $phone3->setNumber("33 33 33 33 33");
        $phone3->setType("fixe pro");
        $phone3->setIsDefault(true);
        $manager->persist($phone3);

        $phone4 = new PhoneNumber();
        $phone4->setNumber("44 44 44 44 44");
        $phone4->setType("fixe perso");
        $phone4->setIsDefault(false);
        $manager->persist($phone4);

        $manager->flush();
        $this->addReference("phone1", $phone1);
        $this->addReference("phone2", $phone2);
        $this->addReference("phone3", $phone3);
        $this->addReference("phone4", $phone4);
    }

    public function getOrder()
    {
        return 20;
    }
}
