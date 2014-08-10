<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 10/08/2014
 * Time: 10:35
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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, ['label'=>'Prénom'])
            ->add('lastname', null, ['label'=>'Nom'])
            ->add('username', null, ['label'=>'Pseudo'])
            ->add('password', 'password', ['label'=>'Mot de passe'])
            ->add('emails', 'collection', ['label'=>'Emails','type'=>new SimpleEmailType(),  'allow_add'=>true, 'by_reference'=>false])
            ->add('phones', 'collection', ['label'=>'Téléphones','type'=>new PhoneType(), 'allow_add'=>true, 'by_reference'=>false])
            ->add('save', 'submit',['label'=>'Enregistrer'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'ZPB\Admin\CommonBundle\Entity\User',
        ]);
    }


    public function getName()
    {
        return 'user_form';
    }
}
