<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/08/2014
 * Time: 12:58
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

namespace ZPB\Admin\CommonBundle\Listener\Entities;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use ZPB\Admin\CommonBundle\Entity\User;

class UserListener
{
    private $encoder;

    public function __construct(EncoderFactoryInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof User){
            $password = $this->handleEvent($entity);
            if($password){
                $entity->setPassword($password);
            }
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof User){
           if($args->hasChangedField('password')){
               $password = $this->handleEvent($entity);
               if($password){
                   $args->setNewValue('password', $password);
               }
           }
        }
    }

    private function handleEvent(User $user)
    {
        if(!$user->getPlainPassword()){
            return false;
        }
        $encoder = $this->encoder->getEncoder($user);
        $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        return $password;
    }
}
