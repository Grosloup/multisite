<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * SponsorshipDesc
 *
 * @ORM\Table(name="zpb_sponsorship_sponsorships_desc")
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\SponsorshipDescRepository")
 * @UniqueEntity("name", message="Ce nom d'offre est déjà utilisé.")
 */
class SponsorshipDesc
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
     * @var string
     * @Gedmo\Slug(fields={"name"}, unique=true)
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     */
    private $slug;

    /**
     * @var float
     *
     * @ORM\Column(name="taxFreePrice", type="float", nullable=false)
     */
    private $taxFreePrice;

    /**
     * @var float
     *
     * @ORM\Column(name="taxRate", type="float", nullable=false)
     */
    private $taxRate;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stoppedAt", type="datetime", nullable=true)
     */
    private $stoppedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isCurrentOffer", type="boolean", nullable=false)
     */
    private $isCurrentOffer;

    /**
     * @ORM\ManyToMany(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\GiftDesc", inversedBy="sponsorshipDesc")
     * @ORM\JoinTable(name="zpb_sponsorship_spondesc_giftdesc")
     */
    private $giftDesc;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->giftDesc = new ArrayCollection();
        $this->isCurrentOffer = true;
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return SponsorshipDesc
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return SponsorshipDesc
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

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
     * Set longDescription
     *
     * @param string $longDescription
     * @return SponsorshipDesc
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

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
     * Set slug
     *
     * @param string $slug
     * @return SponsorshipDesc
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get taxFreePrice
     *
     * @return integer
     */
    public function getTaxFreePrice()
    {
        return $this->taxFreePrice;
    }

    /**
     * Set taxFreePrice
     *
     * @param integer $taxFreePrice
     * @return SponsorshipDesc
     */
    public function setTaxFreePrice($taxFreePrice)
    {
        $this->taxFreePrice = $taxFreePrice;

        return $this;
    }

    /**
     * Get taxRate
     *
     * @return float
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * Set taxRate
     *
     * @param float $taxRate
     * @return SponsorshipDesc
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return SponsorshipDesc
     */
    public function setPrice($price)
    {
        $this->price = $price;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SponsorshipDesc
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get stoppedAt
     *
     * @return \DateTime
     */
    public function getStoppedAt()
    {
        return $this->stoppedAt;
    }

    /**
     * Set stoppedAt
     *
     * @param \DateTime $stoppedAt
     * @return SponsorshipDesc
     */
    public function setStoppedAt($stoppedAt)
    {
        $this->stoppedAt = $stoppedAt;

        return $this;
    }

    /**
     * Get isCurrentOffer
     *
     * @return boolean
     */
    public function getIsCurrentOffer()
    {
        return $this->isCurrentOffer;
    }

    /**
     * Set isCurrentOffer
     *
     * @param boolean $isCurrentOffer
     * @return SponsorshipDesc
     */
    public function setIsCurrentOffer($isCurrentOffer)
    {
        $this->isCurrentOffer = $isCurrentOffer;

        return $this;
    }

    /**
     * Add giftDesc
     *
     * @param GiftDesc $giftDesc
     * @return SponsorshipDesc
     */
    public function addGiftDesc(GiftDesc $giftDesc)
    {
        $this->giftDesc[] = $giftDesc;

        return $this;
    }

    /**
     * Remove giftDesc
     *
     * @param GiftDesc $giftDesc
     */
    public function removeGiftDesc(GiftDesc $giftDesc)
    {
        $this->giftDesc->removeElement($giftDesc);
    }

    /**
     * Get giftDesc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGiftDesc()
    {
        return $this->giftDesc;
    }
}
