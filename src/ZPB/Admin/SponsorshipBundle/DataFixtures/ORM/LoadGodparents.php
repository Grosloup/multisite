<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 16:51
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

namespace ZPB\Admin\SponsorshipBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\Admin\SponsorshipBundle\Entity\Godparent;


class LoadGodparents extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $gp1 = new Godparent();
        $gp1->setTmpPassword('aze123rty456uio789pq');
        $gp1->setFirstname('nicolas');
        $gp1->setLastname('canfrère');
        $gp1->setUsername('nicolas41');
        $gp1->setEmail('nico.canfrere@gmail.com');
        $gp1->setPlainPassword('aze123rty456uio789pq');
        $gp1->setPhone('0674065130');
        $gp1->setBirthdate(\DateTime::createFromFormat('Y-m-d','1971-03-05'));
        $gp1->setCivilite('Mr');
        $gp1->setAddress('13 rue Dauphine');
        $gp1->setPostalCode('41130');
        $gp1->setCity('Selles/Cher');
        $gp1->setCountry('France');

        $manager->persist($gp1);

        $manager->flush();

        $this->addReference('sponsor-godparent-1',$gp1);


    }

    public function getOrder()
    {
        return 44;
    }
}
