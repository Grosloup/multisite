<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 13:32
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

namespace ZPB\Admin\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ZPB\Admin\BlogBundle\Entity\Tag;

class LoadTags extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $tag1 = new Tag();
        $tag1->setName('bébé');
        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setName('enclos');
        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setName('conservation');
        $manager->persist($tag3);

        $tag4 = new Tag();
        $tag4->setName('recherche');
        $manager->persist($tag4);

        $manager->flush();

        $this->addReference('actu-tag-1',$tag1);
        $this->addReference('actu-tag-2',$tag2);
        $this->addReference('actu-tag-3',$tag3);
        $this->addReference('actu-tag-4',$tag4);

    }

    public function getOrder()
    {
        return 2;
    }
}
