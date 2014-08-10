<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/08/2014
 * Time: 11:52
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

namespace ZPB\Admin\CommonBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminRolesType extends AbstractType
{

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'ZPB\Admin\CommonBundle\Entity\PhoneNumber',
        ]);
    }

    public function getName()
    {
        return 'roles_form';
    }
}
