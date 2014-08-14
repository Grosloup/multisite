<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 14/08/2014
 * Time: 23:53
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

namespace ZPB\Sites\ZooBundle\Listener\Entities;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use ZPB\Admin\SponsorshipBundle\Entity\Godparent;

class GodparentListener
{
    private $encoder;

    public function __construct(EncoderFactoryInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof Godparent){
            $password = $this->handleEvent($entity);
            if($password){
                $entity->setPassword($password);
            }
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof Godparent){
            if($args->hasChangedField('password')){
                $password = $this->handleEvent($entity);
                if($password){
                    $args->setNewValue('password', $password);
                }
            }
        }
    }

    private function handleEvent(Godparent $user)
    {
        if(!$user->getPlainPassword()){
            return false;
        }
        $encoder = $this->encoder->getEncoder($user);
        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        return $password;
    }
}
