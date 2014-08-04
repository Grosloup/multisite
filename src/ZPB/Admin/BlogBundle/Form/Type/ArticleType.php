<?php
/**
 * Created by PhpStorm.
 * User: Nicolas Canfrere
 * Date: 04/08/2014
 * Time: 19:46
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

namespace ZPB\Admin\BlogBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',null, ['label'=>'Titre'])
            ->add('slug', null, ['label'=>'Alias (slug)', 'required'=>'false'])
            ->add('body', 'textarea', ['label'=>'Corps'])
            ->add('excerpt', 'textarea', ['label'=>'Extrait'])
            ->add('category', 'entity', ['label'=>'Catégorie','class'=>'ZPBAdminBlogBundle:Category', 'data_class'=>'ZPB\Admin\BlogBundle\Entity\Category', 'property'=>'name'])
            ->add('tags', 'collection', ['type'=>new SimpleTagType(),'allow_add'=>true, 'by_reference'=>false])
            ->add('save', 'submit', ['label'=>'Enregistrer'])
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZPB\Admin\BlogBundle\Entity\Article',
        ));
    }

    public function getName()
    {
        return "article_form";
    }
}
