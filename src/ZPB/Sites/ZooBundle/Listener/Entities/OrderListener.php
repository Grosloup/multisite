<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 15/08/2014
 * Time: 09:18
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
use ZPB\Admin\SponsorshipBundle\Entity\SponsorshipOrder;

class OrderListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if($entity instanceof SponsorshipOrder){
            $ref = $this->handleEvent($entity);
            if($ref){
                $entity->setRef($ref);
            }
        }
    }

    private function handleEvent(SponsorshipOrder $entity)
    {
        $createdAt = $entity->getCreatedAt();
        $ref = $createdAt->format("ymd") . "-" . substr(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36),0,8);

        return $ref;
    }
}
