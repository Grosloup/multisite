<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 15/08/2014
 * Time: 00:02
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

class GodparentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, ['label'=>'Prénom*'])
            ->add('lastname', null, ['label'=>'Nom*'])
            ->add('username', null, ['label'=>'pseudo*'])
            ->add('email','email',['label'=>'Adresse email*'])
            ->add('phone',null,['label'=>'Numéro de téléphone*'])
            ->add('address', null,['label'=>'Adresse 1*'])
            ->add('address2', null,['label'=>'Adresse 2'])
            ->add('batiment', null, ['label'=>'Bâtiment'])
            ->add('door', null,['label'=>'Porte'])
            ->add('floor', null, ['label'=>'Etage'])
            ->add('postalCode', null, ['label'=>'Code postal*'])
            ->add('city', null, ['label'=>'Ville*'])
            ->add('country', null, ['label'=>'Pays*'])
            ->add('birthdate', null, ['label'=>'Date de naissance (jj/mm/yyyy)*'])
            ->add('civilite', 'collection', ['label'=>'Civilité', 'type'=>'civility_type', 'allow_add'=>false, 'by_reference'=>false])
            ->add('save', 'submit', ['label'=>'Enregistrer'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>'ZPB\Admin\SponsorshipBundle\Entity\Godparent',
        ]);
    }

    public function getName()
    {
        return 'godparent_form';
    }
}
