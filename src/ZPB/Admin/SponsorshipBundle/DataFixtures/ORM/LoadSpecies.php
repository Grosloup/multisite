<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 13/08/2014
 * Time: 11:13
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
use ZPB\Admin\SponsorshipBundle\Entity\Species;

class LoadSpecies extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $species1 = new Species();
        $species1->setName("chimpanzé");
        $species1->setLongName('Le chimpanzé d\'Afrique centrale');
        $species1->setShortDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>');
        $species1->setLongDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>');
        $species1->setLifespan('50 à 60 ans en captivité');
        $species1->setGenus('Pan troglodytes');
        $species1->setAnimalOrder('Primate');
        $species1->setClass('Mammifère');
        $species1->setFamily('Hominidé');
        $species1->setGeoDistribution('Afrique centrale et de l\'ouest');
        $species1->setGestation('8 à 9 mois, 1 petit');
        $species1->setDiet('Omnivore');
        $species1->setSize('Jusqu\'à 1,7m debout, les femelles sont plus petites.');
        $species1->setWeight('Jusqu\'à 70kg');
        $species1->setHabitat('Forêts tropicales');
        $species1->setStatusIUCN('Espèce en danger (EN)');

        $manager->persist($species1);

        $species2 = new Species();
        $species2->setName("lion");
        $species2->setLongName('Le lion du Kruger');
        $species2->setShortDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>');
        $species2->setLongDesc('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>');
        $species2->setLifespan('10 à 15 ans dans la nature, 20 ans en captivité');
        $species2->setGenus('Panthera leo');
        $species2->setAnimalOrder('Carnivore');
        $species2->setClass('Mammifère');
        $species2->setFamily('Félidé');
        $species2->setGeoDistribution('Afrique centrale et du sud');
        $species2->setGestation('110 jours, 1 à 4 petits');
        $species2->setDiet('Carnivore');
        $species2->setSize('Jusqu\'à 2.5m de long, les femelles sont plus petites.');
        $species2->setWeight('Jusqu\'à 250kg');
        $species2->setHabitat('Savane');
        $species2->setStatusIUCN('Espèce vulnérable (VU)');

        $manager->persist($species2);



        $manager->flush();

        $this->addReference('sponsor-species-1', $species1);
        $this->addReference('sponsor-species-2', $species2);


    }

    public function getOrder()
    {
        return 45;
    }
}
