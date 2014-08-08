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
use ZPB\Admin\BlogBundle\Form\DataTransformer\CategoryTransformer;

class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $transformer = new CategoryTransformer($em);
        $builder->add('title',null, ['label'=>'Titre'])
            ->add('slug', null)
            ->add('body', 'textarea', ['label'=>'Corps'])
            ->add('excerpt', 'textarea', ['label'=>'Extrait'])
            ->add($builder->create('category','entity', ['label'=>'Catégorie','class'=>'ZPBAdminBlogBundle:Category', 'data_class'=>'ZPB\Admin\BlogBundle\Entity\Category', 'property'=>'name'])->addModelTransformer($transformer))
            //->add('category', 'entity', ['label'=>'Catégorie','class'=>'ZPBAdminBlogBundle:Category', 'data_class'=>'ZPB\Admin\BlogBundle\Entity\Category', 'property'=>'name'])
            ->add('tags', 'collection', ['label'=>'Mots-clés','type'=>new SimpleTagType(),'allow_add'=>true, 'by_reference'=>false])
            ->add('isFrontZoo',null,['label'=>'du ZooParc'])
            ->add('isFrontBn',null,['label'=>'de B.Nature'])
            ->add('saveDraft', 'submit', ['label'=>'Enregistrer le brouillon'])
            ->add('savePublish', 'submit', ['label'=>'Enregistrer et publier'])
            //->add('saveFront', 'submit', ['label'=>'Enregistrer à la une'])
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZPB\Admin\BlogBundle\Entity\Article',
        ));

        $resolver->setRequired(['em']);
        $resolver->setAllowedTypes(['em'=>'\Doctrine\Common\Persistence\ObjectManager']);
    }

    public function getName()
    {
        return "article_form";
    }
}
