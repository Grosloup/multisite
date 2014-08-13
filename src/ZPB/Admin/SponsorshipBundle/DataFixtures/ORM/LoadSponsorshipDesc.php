<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 16:58
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
use ZPB\Admin\SponsorshipBundle\Entity\SponsorshipDesc;

class LoadSponsorshipDesc extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $sponGd1 = new SponsorshipDesc();
        $sponGd1->setName('Argent de poche');
        $sponGd1->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vulputate euismod quam. Maecenas lobortis ipsum quis quam pretium ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer sed scelerisque tellus. Sed laoreet ligula vel luctus aliquet.</p>');
        $sponGd1->setLongDescription('<p>Sed scelerisque magna feugiat augue gravida, in interdum lectus lacinia. Duis scelerisque eleifend lobortis. Duis id arcu in turpis aliquet blandit id eu dui. Nullam non condimentum metus, id adipiscing dolor. Vivamus vitae laoreet enim. Morbi vitae facilisis augue. Duis tincidunt, leo ut tincidunt vehicula, ante velit varius lacus, hendrerit venenatis tortor quam ut sapien. Morbi ultricies commodo adipiscing. Pellentesque sollicitudin purus dui, sed tristique mi tempus eu. Mauris eu tincidunt dolor, sed laoreet odio.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vulputate euismod quam. Maecenas lobortis ipsum quis quam pretium ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer sed scelerisque tellus. Sed laoreet ligula vel luctus aliquet.</p>');
        $sponGd1->setPrice(15);
        $sponGd1->setTaxRate(0.2);
        $sponGd1->setTaxFreePrice(15*0.8);
        $sponGd1->getIsCurrentOffer(true);
        $sponGd1->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addSponsorshipDesc($sponGd1);
        $sponGd1->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addSponsorshipDesc($sponGd1);





        $sponGd2 = new SponsorshipDesc();
        $sponGd2->setName('Baobab');
        $sponGd2->setShortDescription('<p>Aenean in sapien suscipit enim sagittis pellentesque non vitae eros. Nunc eu felis leo. Nullam tellus massa, adipiscing faucibus ligula a, facilisis pellentesque lorem. Mauris condimentum sapien nibh, ut congue quam imperdiet in. Vivamus adipiscing quam ut purus condimentum, et iaculis urna euismod.</p>');
        $sponGd2->setLongDescription('<p>Cras vel elit lobortis, pretium elit at, pretium velit. Phasellus sapien arcu, consectetur ac vehicula vel, dictum vel augue. Ut luctus magna sit amet diam pretium, at vehicula risus dignissim. Suspendisse eleifend eros at orci tincidunt, ut dapibus massa rhoncus. Sed cursus sodales venenatis. Quisque et venenatis tortor. Fusce est ante, tempor in luctus non, malesuada vitae dolor. Sed consectetur mauris vitae mattis rutrum. Donec ornare risus ut mi congue, sed venenatis turpis malesuada.</p><p>Aenean in sapien suscipit enim sagittis pellentesque non vitae eros. Nunc eu felis leo. Nullam tellus massa, adipiscing faucibus ligula a, facilisis pellentesque lorem. Mauris condimentum sapien nibh, ut congue quam imperdiet in. Vivamus adipiscing quam ut purus condimentum, et iaculis urna euismod.</p>');
        $sponGd2->setPrice(80);
        $sponGd2->setTaxRate(0.2);
        $sponGd2->setTaxFreePrice(80*0.8);
        $sponGd2->getIsCurrentOffer(true);
        $sponGd2->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addSponsorshipDesc($sponGd2);
        $sponGd2->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-3'));
        $this->getReference('zpb-sponsor-gift-desc-3')->addSponsorshipDesc($sponGd2);




        $sponGd3 = new SponsorshipDesc();
        $sponGd3->setName('Analabé');
        $sponGd3->setShortDescription('<p>Quisque dapibus ut ipsum sed consequat. Pellentesque commodo mauris eu dolor sagittis tempor. Quisque convallis sem sit amet lorem euismod aliquam. Nunc ultrices venenatis dignissim. Aliquam suscipit quam eu lacus rutrum, id viverra enim adipiscing.</p>');
        $sponGd3->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare.</p><p>Quisque dapibus ut ipsum sed consequat. Pellentesque commodo mauris eu dolor sagittis tempor. Quisque convallis sem sit amet lorem euismod aliquam. Nunc ultrices venenatis dignissim. Aliquam suscipit quam eu lacus rutrum, id viverra enim adipiscing.</p>');
        $sponGd3->setPrice(300);
        $sponGd3->setTaxRate(0.2);
        $sponGd3->setTaxFreePrice(300*0.8);
        $sponGd3->getIsCurrentOffer(true);
        $sponGd3->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-1'));
        $this->getReference('zpb-sponsor-gift-desc-1')->addSponsorshipDesc($sponGd3);
        $sponGd3->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-2'));
        $this->getReference('zpb-sponsor-gift-desc-2')->addSponsorshipDesc($sponGd3);
        $sponGd3->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-4'));
        $this->getReference('zpb-sponsor-gift-desc-4')->addSponsorshipDesc($sponGd3);
        $sponGd3->addGiftDesc($this->getReference('zpb-sponsor-gift-desc-5'));
        $this->getReference('zpb-sponsor-gift-desc-5')->addSponsorshipDesc($sponGd3);



        $manager->persist($this->getReference('zpb-sponsor-gift-desc-1'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-2'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-3'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-4'));
        $manager->persist($this->getReference('zpb-sponsor-gift-desc-5'));

        $manager->persist($sponGd1);
        $manager->persist($sponGd2);
        $manager->persist($sponGd3);


        $manager->flush();

        $this->addReference('zpb-sponsor-sponsor-desc-1', $sponGd1);
        $this->addReference('zpb-sponsor-sponsor-desc-2', $sponGd2);
        $this->addReference('zpb-sponsor-sponsor-desc-3', $sponGd3);


    }

    public function getOrder()
    {
        return 41;
    }
}
