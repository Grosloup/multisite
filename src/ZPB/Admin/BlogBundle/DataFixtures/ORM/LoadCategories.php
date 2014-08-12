<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 13:08
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
use ZPB\Admin\BlogBundle\Entity\Category;

class LoadCategories extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $cat1 = new Category();
        $cat1->setName("Générale");
        $cat1->setIsDefault(true);
        $manager->persist($cat1);

        $cat2 = new Category();
        $cat2->setName("Nouveauté");
        $cat2->setIsDefault(false);
        $manager->persist($cat2);

        $cat3 = new Category();
        $cat3->setName("Carnet rose");
        $cat3->setIsDefault(false);
        $manager->persist($cat3);

        $cat4 = new Category();
        $cat4->setName("Journée Beauval Conservation");
        $cat4->setIsDefault(false);
        $manager->persist($cat4);

        $manager->flush();
        $this->addReference('actu-cat-1', $cat1);
        $this->addReference('actu-cat-2', $cat2);
        $this->addReference('actu-cat-3', $cat3);
        $this->addReference('actu-cat-4', $cat4);
    }

    public function getOrder()
    {
        return 4;
    }
}
