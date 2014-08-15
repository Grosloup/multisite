<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 13/08/2014
 * Time: 10:26
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
use ZPB\Admin\SponsorshipBundle\Entity\Animal;

class LoadAnimals extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $animal1 = new Animal();
        $animal1->setName("Joseph");
        $animal1->setBirthdate(\DateTime::createFromFormat('d-m-Y H:i:s', '01-01-1990 12:00:00', new \DateTimeZone('Europe/Paris')));
        $animal1->setShortDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>');
        $animal1->setLongDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>');
        $animal1->setLongName('Joseph, le mâle chimpanzé');
        $animal1->setBirthPlace('Jurques');
        $animal1->setSexe('mâle');
        $animal1->setHistory('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>');
        $animal1->setIsAvailable(true);
        $animal1->setSpecies($this->getReference('sponsor-species-1'));

        $manager->persist($animal1);

        $animal2 = new Animal();
        $animal2->setName("Makwalo");
        $animal2->setBirthdate(\DateTime::createFromFormat('d-m-Y H:i:s', '01-01-2001 12:00:00', new \DateTimeZone('Europe/Paris')));
        $animal2->setShortDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>');
        $animal2->setLongDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>');
        $animal2->setLongName('Makwalo, le mâle lion');
        $animal2->setBirthPlace('Afrique du sud');
        $animal2->setSexe('mâle');
        $animal2->setHistory('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>');
        $animal2->setIsAvailable(true);
        $animal2->setSpecies($this->getReference('sponsor-species-2'));

        $manager->persist($animal2);

        $animal3 = new Animal();
        $animal3->setName("Joseph");
        $animal3->setBirthdate(\DateTime::createFromFormat('d-m-Y H:i:s', '01-01-1996 12:00:00', new \DateTimeZone('Europe/Paris')));
        $animal3->setShortDesc('<p>Maecenas et odio bibendum, ornare metus sed, vehicula odio. Vestibulum ante ipsum primis in faucibus orci.</p>');
        $animal3->setLongDesc('<p>Integer imperdiet placerat hendrerit. Fusce eu neque ut felis faucibus euismod a id urna. Morbi ut mauris a leo accumsan semper vel non purus. Duis porttitor tortor a enim rutrum, at porta leo consequat. Ut mattis eget sapien et fermentum. Donec ac ligula mollis, venenatis massa quis, accumsan risus. Maecenas tristique sapien eu diam cursus elementum. Proin quis dolor ac nisl laoreet laoreet a eget ante. Nam ultrices fermentum lectus, vel feugiat arcu porttitor sed. In eu adipiscing justo. Mauris porttitor tempor nunc et dignissim. Morbi a lectus sit amet nibh eleifend aliquet vel at sapien. Praesent tempor felis id semper bibendum. Nam mattis eu ipsum in elementum. </p><p>Maecenas vestibulum, orci eget venenatis venenatis, risus ante commodo nibh, non tristique nunc nunc eget felis. Fusce dolor arcu, dictum sit amet diam quis, vestibulum rhoncus ligula. Aliquam in mi faucibus, adipiscing dolor vel, sodales massa. Quisque nec vestibulum turpis. Integer convallis faucibus consequat.</p>');
        $animal3->setLongName('Joseph, le mâle girafe');
        $animal3->setBirthPlace('Afrique du sud');
        $animal3->setSexe('mâle');
        $animal3->setHistory('<p>Pellentesque eu venenatis massa. Etiam tempus ipsum odio, quis venenatis mi blandit et. Suspendisse dapibus urna eu pharetra elementum. Quisque tempus feugiat magna ac condimentum. In dolor enim, posuere ut pharetra sit amet, malesuada vitae augue. Nulla id nisl vulputate, scelerisque mauris et, suscipit dolor. Curabitur rhoncus porta eros, eu tempor tortor tincidunt vitae. Curabitur blandit porta quam. Donec aliquet, enim id lobortis sagittis, odio orci tincidunt libero, vitae placerat magna elit sed magna. Vestibulum placerat nec massa nec luctus. Morbi quis convallis augue, eu hendrerit elit. Fusce ac nibh faucibus tortor molestie ultricies eget faucibus turpis. </p>');
        $animal3->setIsAvailable(true);
        $animal3->setSpecies($this->getReference('sponsor-species-3'));

        $manager->persist($animal3);

        $manager->flush();

        $this->addReference('sponsor-animal-1',$animal1);
        $this->addReference('sponsor-animal-2',$animal2);
        $this->addReference('sponsor-animal-3',$animal3);


    }

    public function getOrder()
    {
        return 46;
    }
}
