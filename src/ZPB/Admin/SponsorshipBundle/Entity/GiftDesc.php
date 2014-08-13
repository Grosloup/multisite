<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * GiftDesc
 *
 * @ORM\Table(name="zpb_sponsorship_gift_desc")
 *
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\GiftDescRepository")
 * @UniqueEntity("name", message="Ce nom de cadeau est déjà utilisé.")
 */
class GiftDesc
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
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     * @Gedmo\Slug(fields={"name"}, unique=true)
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     */
    private $slug;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="shortDescription", type="text", nullable=false)
     */
    private $shortDescription;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="longDescription", type="text", nullable=false)
     */
    private $longDescription;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\SponsorshipDesc", mappedBy="giftDesc")
     */
    private $sponsorshipDesc;


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
     * @return GiftDesc
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
     * @return GiftDesc
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
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return GiftDesc
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return GiftDesc
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sponsorshipDesc = new ArrayCollection();
    }

    /**
     * Add sponsorshipDesc
     *
     * @param SponsorshipDesc $sponsorshipDesc
     * @return GiftDesc
     */
    public function addSponsorshipDesc(SponsorshipDesc $sponsorshipDesc)
    {
        $this->sponsorshipDesc[] = $sponsorshipDesc;

        return $this;
    }

    /**
     * Remove sponsorshipDesc
     *
     * @param SponsorshipDesc $sponsorshipDesc
     */
    public function removeSponsorshipDesc(SponsorshipDesc $sponsorshipDesc)
    {
        $this->sponsorshipDesc->removeElement($sponsorshipDesc);
    }

    /**
     * Get sponsorshipDesc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsorshipDesc()
    {
        return $this->sponsorshipDesc;
    }
}
