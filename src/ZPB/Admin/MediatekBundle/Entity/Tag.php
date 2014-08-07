<?php

namespace ZPB\Admin\MediatekBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Tag
 *
 * @ORM\Table(name="zpb_media_tags")
 * @ORM\Entity(repositoryClass="ZPB\Admin\MediatekBundle\Entity\TagRepository")
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
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'., _-]*$/", message="Ce champ contient des caractères non autorisés.")
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
     * @ORM\ManyToMany(targetEntity="ZPB\Admin\MediatekBundle\Entity\Image", mappedBy="tags")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\Admin\MediatekBundle\Entity\Pdf", mappedBy="tags")
     */
    private $pdfs;


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
        $this->images = new ArrayCollection();
        $this->pdfs = new ArrayCollection();
    }

    /**
     * Add images
     *
     * @param Image $images
     * @return Tag
     */
    public function addImage(Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param Image $images
     */
    public function removeImage(Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add pdfs
     *
     * @param Pdf $pdfs
     * @return Tag
     */
    public function addPdf(Pdf $pdfs)
    {
        $this->pdfs[] = $pdfs;

        return $this;
    }

    /**
     * Remove pdfs
     *
     * @param Pdf $pdfs
     */
    public function removePdf(Pdf $pdfs)
    {
        $this->pdfs->removeElement($pdfs);
    }

    /**
     * Get pdfs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPdfs()
    {
        return $this->pdfs;
    }
}
