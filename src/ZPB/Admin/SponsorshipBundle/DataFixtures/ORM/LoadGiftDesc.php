<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 12/08/2014
 * Time: 16:56
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
use ZPB\Admin\SponsorshipBundle\Entity\GiftDesc;

class LoadGiftDesc extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        $g1 = new GiftDesc();
        $g1->setName('Photo numérique');
        $g1->setShortDescription('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vulputate euismod quam. Maecenas lobortis ipsum quis quam pretium ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>');
        $g1->setLongDescription('<p>Integer sed scelerisque tellus. Sed laoreet ligula vel luctus aliquet. Etiam ut ligula sit amet nisl elementum tincidunt. Praesent aliquam ut nibh sit amet ultrices. Nulla ornare augue convallis augue blandit facilisis.</p><p>Aenean pulvinar neque sit amet elit lacinia, et convallis lorem bibendum. Nulla a dapibus nibh, eget vehicula quam. Etiam id metus pretium, aliquet enim tempus, venenatis nisl. Nunc ac arcu nec metus vehicula sagittis. Phasellus lectus arcu, suscipit vitae scelerisque ut, mattis vitae lorem. Sed rutrum sem ac nunc elementum, vel posuere eros rhoncus. Praesent ultricies elementum lorem quis tristique.</p>');

        $manager->persist($g1);

        $g2 = new GiftDesc();
        $g2->setName('Certificat de parrainage');
        $g2->setShortDescription('<p>Aenean in sapien suscipit enim sagittis pellentesque non vitae eros. Nunc eu felis leo. Nullam tellus massa, adipiscing faucibus ligula a, facilisis pellentesque lorem.</p>');
        $g2->setLongDescription('<p>Mauris condimentum sapien nibh, ut congue quam imperdiet in. Vivamus adipiscing quam ut purus condimentum, et iaculis urna euismod. Quisque tincidunt, ipsum vitae dictum hendrerit, lorem urna congue turpis, quis luctus nunc mauris ut massa. Nulla iaculis aliquet urna non varius. Nam molestie venenatis sem, in fringilla turpis. Cras sollicitudin in arcu venenatis imperdiet. Cras id massa in nisl tristique fermentum sit amet sed arcu. Vestibulum eleifend lobortis quam ut dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lacinia porttitor ipsum, eu molestie metus blandit pellentesque. Integer ullamcorper ornare nunc, a bibendum purus.</p><p>Praesent mauris lacus, imperdiet a accumsan eu, egestas eu lacus. Donec fermentum sodales turpis, vitae sodales quam ultricies non. </p>');

        $manager->persist($g2);


        $g3 = new GiftDesc();
        $g3->setName('Fiche de l\'animal');
        $g3->setShortDescription('<p>Quisque dapibus ut ipsum sed consequat. Pellentesque commodo mauris eu dolor sagittis tempor. Quisque convallis sem sit amet lorem euismod aliquam.</p>');
        $g3->setLongDescription('<p>Nunc ultrices venenatis dignissim. Aliquam suscipit quam eu lacus rutrum, id viverra enim adipiscing. Cras nunc erat, ultricies ut erat non, placerat blandit orci. Nulla a convallis augue. Vivamus massa sapien, euismod non velit non, suscipit ultrices tortor. </p><p>Sed scelerisque magna feugiat augue gravida, in interdum lectus lacinia. Duis scelerisque eleifend lobortis. Duis id arcu in turpis aliquet blandit id eu dui. Nullam non condimentum metus, id adipiscing dolor. Vivamus vitae laoreet enim. Morbi vitae facilisis augue. Duis tincidunt, leo ut tincidunt vehicula, ante velit varius lacus, hendrerit venenatis tortor quam ut sapien. Morbi ultricies commodo adipiscing. Pellentesque sollicitudin purus dui, sed tristique mi tempus eu. Mauris eu tincidunt dolor, sed laoreet odio.</p>');

        $manager->persist($g3);

        $g4 = new GiftDesc();
        $g4->setName('Fiche programme');
        $g4->setShortDescription('<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>');
        $g4->setLongDescription('<p>In pharetra dui sed aliquam congue. Nunc vehicula convallis magna eget ultricies. Cras suscipit lectus ullamcorper massa pellentesque porta eget sed tellus. Nunc eu sapien in felis consectetur adipiscing. Fusce a tincidunt erat, vitae pulvinar neque. Ut ac est dictum, gravida mi a, dignissim sapien. Aliquam ut elit vel ligula posuere viverra at eget augue. Sed gravida nec sapien et convallis.</p><p>Cras vel elit lobortis, pretium elit at, pretium velit. Phasellus sapien arcu, consectetur ac vehicula vel, dictum vel augue. Ut luctus magna sit amet diam pretium, at vehicula risus dignissim. Suspendisse eleifend eros at orci tincidunt, ut dapibus massa rhoncus. Sed cursus sodales venenatis. Quisque et venenatis tortor. Fusce est ante, tempor in luctus non, malesuada vitae dolor. Sed consectetur mauris vitae mattis rutrum. Donec ornare risus ut mi congue, sed venenatis turpis malesuada.</p>');

        $manager->persist($g4);


        $g5 = new GiftDesc();
        $g5->setName('Fond d\'écran de l\'espèce');
        $g5->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g5->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g5);
        //

        $g6 = new GiftDesc();
        $g6->setName('Tableau d\'honneur');
        $g6->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g6->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g6);

        $g7 = new GiftDesc();
        $g7->setName('NewsLetter');
        $g7->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g7->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g7);

        $g8 = new GiftDesc();
        $g8->setName('Jeu de piste');
        $g8->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g8->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g8);

        $g9 = new GiftDesc();
        $g9->setName('1 entée gratuite');
        $g9->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g9->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g9);

        $g10 = new GiftDesc();
        $g10->setName('2 entées gratuites');
        $g10->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g10->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g10);

        $g11 = new GiftDesc();
        $g11->setName('3 entées gratuites');
        $g11->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g11->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g11);

        $g12 = new GiftDesc();
        $g12->setName('ZooPass 1 an');
        $g12->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g12->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g12);

        $g13 = new GiftDesc();
        $g13->setName('Série de posters');
        $g13->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g13->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g13);

        $g14 = new GiftDesc();
        $g14->setName('Goodies');
        $g14->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g14->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g14);

        $g15 = new GiftDesc();
        $g15->setName('Visite guidée (1h)');
        $g15->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g15->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g15);

        $g16 = new GiftDesc();
        $g16->setName('Visite guidée (jounée)');
        $g16->setShortDescription('<p>Praesent faucibus, risus id elementum viverra, purus purus pharetra leo, a porta tortor risus quis lacus. Donec quis rhoncus libero, at venenatis orci. Vestibulum vestibulum elementum quam nec volutpat. </p>');
        $g16->setLongDescription('<p>Nunc sed tortor a nulla euismod adipiscing sed eu leo. Aliquam erat volutpat. Donec fringilla at purus quis tincidunt. Duis iaculis ac sapien ut adipiscing. In hac habitasse platea dictumst. Aliquam quis mauris justo. Ut dui enim, ullamcorper iaculis diam in, vehicula aliquam massa. Aliquam erat volutpat. Morbi dignissim malesuada viverra. Nulla tristique sem in turpis ornare volutpat. Donec sed metus tristique, commodo diam sed, auctor arcu. Morbi a orci sapien. Mauris blandit ultrices ornare. Vivamus vel dui ac dolor euismod pulvinar nec vitae velit. Donec tempus, sapien quis porttitor feugiat, neque neque lacinia dui, vitae tincidunt nibh ante non tellus. In cursus posuere varius.</p><p>Nulla consequat ullamcorper sem, vitae pulvinar arcu gravida ac. Nullam aliquet, nisi sed ultricies rutrum, dui lectus varius risus, sit amet vulputate dolor quam in arcu. Duis arcu lorem, feugiat sit amet tortor eu, iaculis suscipit turpis. Donec pulvinar sagittis urna, quis rutrum est blandit nec. Donec in odio diam. Curabitur quis ullamcorper nulla. Vestibulum sit amet bibendum mi. Phasellus congue malesuada augue nec elementum. Proin vel elit a lacus adipiscing sagittis. Donec malesuada in urna ultrices laoreet. Etiam in nulla a est iaculis blandit non id turpis.</p>');

        $manager->persist($g16);

        $manager->flush();

        $this->addReference('zpb-sponsor-gift-desc-1',$g1);
        $this->addReference('zpb-sponsor-gift-desc-2',$g2);
        $this->addReference('zpb-sponsor-gift-desc-3',$g3);
        $this->addReference('zpb-sponsor-gift-desc-4',$g4);
        $this->addReference('zpb-sponsor-gift-desc-5',$g5);
        $this->addReference('zpb-sponsor-gift-desc-6',$g6);
        $this->addReference('zpb-sponsor-gift-desc-7',$g7);
        $this->addReference('zpb-sponsor-gift-desc-8',$g8);
        $this->addReference('zpb-sponsor-gift-desc-9',$g9);
        $this->addReference('zpb-sponsor-gift-desc-10',$g10);
        $this->addReference('zpb-sponsor-gift-desc-11',$g11);
        $this->addReference('zpb-sponsor-gift-desc-12',$g12);
        $this->addReference('zpb-sponsor-gift-desc-13',$g13);
        $this->addReference('zpb-sponsor-gift-desc-14',$g14);
        $this->addReference('zpb-sponsor-gift-desc-15',$g15);
        $this->addReference('zpb-sponsor-gift-desc-16',$g16);
    }

    public function getOrder()
    {
        return 40;
    }
}
