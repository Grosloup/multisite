<?php

namespace ZPB\Admin\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tag
 *
 * @ORM\Table(name="zpb_blog_tags")
 * @ORM\Entity(repositoryClass="ZPB\Admin\BlogBundle\Entity\TagRepository")
 * @UniqueEntity("name")
 */
class Tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     * @Assert\NotBlank(message="Ce champ est requis.")
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' _-]*$/", message="Ce champ contient des caractères non autorisés.")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true, unique=true)
     * @Gedmo\Slug(fields={"name"})
     * @Assert\Regex("/^[a-zA-Z0-9_-]*$/", message="Ce champ contient des caractères non autorisés.")
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\Admin\BlogBundle\Entity\Article", mappedBy="tags")
     *
     */
    private $articles;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Tag
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * Add articles
     *
     * @param Article $article
     * @return Tag
     */
    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
        return $this;
    }

    /**
     * Remove articles
     *
     * @param Article $articles
     */
    public function removeArticle(Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
