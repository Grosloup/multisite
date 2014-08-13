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


        $species3 = new Species();
        $species3->setName("girafe");
        $species3->setLongName('La girafe d\'Afrique du sud');
        $species3->setShortDesc('<p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis.</p>');
        $species3->setLongDesc('<p>Aliquam malesuada est ligula, sed auctor enim fringilla et. Cras ut velit non eros laoreet malesuada. Donec fermentum sed nibh et malesuada. Aenean et erat accumsan, venenatis odio nec, pretium orci. Curabitur a pellentesque urna. In sit amet nulla ac magna placerat mollis nec eu urna. Donec sit amet nunc sollicitudin, congue velit sit amet, pharetra nisl. Curabitur malesuada massa pharetra est imperdiet, et ultrices libero semper. Sed dui sem, auctor vel purus eu, dictum dictum lorem. Sed consequat quam lectus, quis viverra turpis condimentum id. </p><p>Fusce at ante ac ligula volutpat malesuada. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer ultrices sapien ipsum, sit amet rutrum nisl pharetra facilisis. Vivamus massa turpis, laoreet non libero vitae, pretium rutrum massa. Etiam eleifend faucibus felis, ac laoreet nisi dictum id. Curabitur gravida sit amet nisl sit amet blandit. Vestibulum at lectus venenatis, pretium risus a, eleifend sapien. Cras leo nibh, ullamcorper sit amet iaculis id, sodales ut tortor. Aenean semper porta tempus.</p>');
        $species3->setLifespan('20 à 30 ans');
        $species3->setGenus('Giraffa camelopardalis');
        $species3->setAnimalOrder('Artiodactyle');
        $species3->setClass('Mammifère');
        $species3->setFamily('Giraffidé');
        $species3->setGeoDistribution('Afrique centrale et du sud');
        $species3->setGestation('entre 400 et 460 jours, 1 girafon');
        $species3->setDiet('Folivore');
        $species3->setSize('De 4.5 à 5.8m.');
        $species3->setWeight('entre 800kg et 1500kg');
        $species3->setHabitat('Savane');
        $species3->setStatusIUCN('Préoccupation mineure (LC)');

        $manager->persist($species3);


        $manager->flush();

        $this->addReference('sponsor-species-1', $species1);
        $this->addReference('sponsor-species-2', $species2);
        $this->addReference('sponsor-species-3', $species3);


    }

    public function getOrder()
    {
        return 45;
    }
}
