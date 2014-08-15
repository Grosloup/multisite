<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 15/08/2014
 * Time: 18:43
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

namespace ZPB\Sites\ZooBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewPasswordType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', 'password', ['label'=>'Entrez votre mot de passe actuel'])
            ->add('newPassword', 'repeated',
                [
                    'type'=>'password',
                    'invalid_message'=>'Les mots de passe doivent correspondre',
                    'first_options' => ['label'=>'Entrez votre nouveau mot de passe'],
                    'second_options' => ['label'=>'Repeter votre nouveau mot de passe']
                ])
            ->add('save', 'submit', ['label'=>'Sauvegarder'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
           'data_class'=>'ZPB\Sites\ZooBundle\Form\Model\ChangePassword'
        ]);
    }

    public function getName()
    {
        return 'new_pass_form';
    }
}
