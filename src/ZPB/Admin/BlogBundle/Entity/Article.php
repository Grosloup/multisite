<?php

namespace ZPB\Admin\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Article
 *
 * @ORM\Table(name="zpb_blog_articles")
 * @ORM\Entity(repositoryClass="ZPB\Admin\BlogBundle\Entity\ArticleRepository")
 * @UniqueEntity("longId")
 */
class Article
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
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç' _-]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true, nullable=true)
     * @Gedmo\Slug(fields={"title"})
     * @Assert\Regex("/^[a-zA-Z0-9_-]*$/", message="Ce champ contient des caractères non autorisés.")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text", nullable=true)
     */
    private $excerpt;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_draft", type="boolean")
     */
    private $isDraft;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_published", type="boolean")
     */
    private $isPublished;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_dropped", type="boolean")
     */
    private $isDropped;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_delayed", type="boolean")
     */
    private $isDelayed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_front_zoo", type="boolean")
     */
    private $isFrontZoo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_front_bn", type="boolean")
     */
    private $isFrontBn;

    /**
     * @var \DateTime
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="tobe_published_at", type="datetime", nullable=true)
     */
    private $tobePublishedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="view_counter", type="integer", nullable=true)
     */
    private $viewCounter;

    /**
     * @var integer
     *
     * @ORM\Column(name="long_id", type="integer", nullable=false)
     */
    private $longId;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\Admin\BlogBundle\Entity\Tag", inversedBy="articles")
     * @ORM\JoinTable(name="zpb_blog_articles_tags")
     *
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\BlogBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->isDraft = true;
        $this->isDelayed = false;
        $this->isDropped = false;
        $this->isFrontBn = false;
        $this->isFrontZoo = false;
        $this->isPublished = false;
        $this->viewCounter = 0;
        $longId = md5((new \DateTime("now", new \DateTimeZone("Europe/Paris")))->getTimestamp() . uniqid());
        $this->longId = substr($longId, 0, 8);
    }


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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
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
     * Set excerpt
     *
     * @param string $excerpt
     * @return Article
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string 
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set isDraft
     *
     * @param boolean $isDraft
     * @return Article
     */
    public function setIsDraft($isDraft)
    {
        $this->isDraft = $isDraft;

        return $this;
    }

    /**
     * Get isDraft
     *
     * @return boolean 
     */
    public function getIsDraft()
    {
        return $this->isDraft;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Article
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set isDropped
     *
     * @param boolean $isDropped
     * @return Article
     */
    public function setIsDropped($isDropped)
    {
        $this->isDropped = $isDropped;

        return $this;
    }

    /**
     * Get isDropped
     *
     * @return boolean 
     */
    public function getIsDropped()
    {
        return $this->isDropped;
    }

    /**
     * Set isDelayed
     *
     * @param boolean $isDelayed
     * @return Article
     */
    public function setIsDelayed($isDelayed)
    {
        $this->isDelayed = $isDelayed;

        return $this;
    }

    /**
     * Get isDelayed
     *
     * @return boolean 
     */
    public function getIsDelayed()
    {
        return $this->isDelayed;
    }

    /**
     * Set isFrontZoo
     *
     * @param boolean $isFrontZoo
     * @return Article
     */
    public function setIsFrontZoo($isFrontZoo)
    {
        $this->isFrontZoo = $isFrontZoo;

        return $this;
    }

    /**
     * Get isFrontZoo
     *
     * @return boolean 
     */
    public function getIsFrontZoo()
    {
        return $this->isFrontZoo;
    }

    /**
     * Set isFrontBn
     *
     * @param boolean $isFrontBn
     * @return Article
     */
    public function setIsFrontBn($isFrontBn)
    {
        $this->isFrontBn = $isFrontBn;

        return $this;
    }

    /**
     * Get isFrontBn
     *
     * @return boolean 
     */
    public function getIsFrontBn()
    {
        return $this->isFrontBn;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Article
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set tobePublishedAt
     *
     * @param \DateTime $tobePublishedAt
     * @return Article
     */
    public function setTobePublishedAt($tobePublishedAt)
    {
        $this->tobePublishedAt = $tobePublishedAt;

        return $this;
    }

    /**
     * Get tobePublishedAt
     *
     * @return \DateTime 
     */
    public function getTobePublishedAt()
    {
        return $this->tobePublishedAt;
    }

    /**
     * Set viewCounter
     *
     * @param integer $viewCounter
     * @return Article
     */
    public function setViewCounter($viewCounter)
    {
        $this->viewCounter = $viewCounter;

        return $this;
    }

    /**
     * Get viewCounter
     *
     * @return integer 
     */
    public function getViewCounter()
    {
        return $this->viewCounter;
    }

    /**
     * Set longId
     *
     * @param integer $longId
     * @return Article
     */
    public function setLongId($longId)
    {
        $this->longId = $longId;

        return $this;
    }

    /**
     * Get longId
     *
     * @return integer 
     */
    public function getLongId()
    {
        return $this->longId;
    }

    /**
     * Add tags
     *
     * @param Tag $tags
     * @return Article
     */
    public function addTag(Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param Tag $tags
     */
    public function removeTag(Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return Article
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
