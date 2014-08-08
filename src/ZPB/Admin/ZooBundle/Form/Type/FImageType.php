<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrère
 * Date: 08/08/14
 * Time: 16:50
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

namespace ZPB\Admin\ZooBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZPB\Admin\ZooBundle\Form\DataTransformer\CategoryTransformer;

class FImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $transformer = new CategoryTransformer($em);
        $builder
            ->add('name',null)
            ->add('slug',null, ['label'=>'Alias (slug)', 'required'=>'false'])
            ->add($builder->create('category','entity', ['label'=>'Catégorie','class'=>'ZPBAdminZooBundle:FCategory', 'data_class'=>'ZPB\Admin\ZooBundle\Entity\FCategory', 'property'=>'name'])->addModelTransformer($transformer))
            ->add('file', null, ['label'=>'Fichier'])
            ->add('title',null, ['label'=>'Titre'])
            ->add('copyright',null, ['label'=>'Copyright'])
            ->add('legend',null, ['label'=>'Légende (label)'])
        ;
    }

    public function getName()
    {
        return "fimage_form";
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZPB\Admin\ZooBundle\Entity\FImage',
        ));
        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
    }
}
