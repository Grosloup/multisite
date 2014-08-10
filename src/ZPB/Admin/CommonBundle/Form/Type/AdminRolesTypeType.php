<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/08/2014
 * Time: 11:47
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

class AdminRolesTypeType extends AbstractType
{

    private $rolesChoices;

    function __construct(array $rolesChoices)
    {
        $this->rolesChoices = $rolesChoices;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['choices'=>$this->rolesChoices]);
    }

    public function getParent()
    {
        return 'choice';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'admin_roles_type';
    }
}
