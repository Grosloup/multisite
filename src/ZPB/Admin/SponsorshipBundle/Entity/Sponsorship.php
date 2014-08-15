<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sponsorship
 *
 * @ORM\Table(name="zpb_sponsorship_sponsorships")
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\SponsorshipRepository")
 */
class Sponsorship
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
     * @var \DateTime
     * @Assert\NotBlank()
     * @ORM\Column(name="purchasedAt", type="datetime", nullable=false)
     */
    private $purchasedAt;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @ORM\Column(name="endAt", type="datetime", nullable=false)
     */
    private $endAt;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @ORM\Column(name="recallAt", type="datetime", nullable=false)
     */
    private $recallAt;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\SponsorshipDesc")
     * @ORM\JoinColumn(name="sponsorship_desc_id", referencedColumnName="id")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\Gift", mappedBy="sponsorship")
     */
    private $gifts;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\Godparent", inversedBy="sponsorships")
     * @ORM\JoinColumn(name="godparent_id", referencedColumnName="id")
     */
    private $godparent;

    /**
     * @ORM\Column(name="isValid", type="boolean", nullable=false)
     */
    private $isValid;

    /**
     * @ORM\Column(name="validateAt", type="datetime", nullable=true)
     */
    private $validateAt;

    /**
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\Animal")
     * @ORM\JoinColumn(name="animal_id", referencedColumnName="id", nullable=false)
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\Godparent")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gifts = new ArrayCollection();
        $this->isValid = false;
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
     * @return mixed
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }



    /**
     * @return mixed
     */
    public function getValidateAt()
    {
        return $this->validateAt;
    }

    /**
     * @param mixed $validateAt
     */
    public function setValidateAt($validateAt)
    {
        $this->validateAt = $validateAt;
    }

    /**
     * Get purchasedAt
     *
     * @return \DateTime
     */
    public function getPurchasedAt()
    {
        return $this->purchasedAt;
    }

    /**
     * Set purchasedAt
     *
     * @param \DateTime $purchasedAt
     * @return Sponsorship
     */
    public function setPurchasedAt($purchasedAt)
    {
        $this->purchasedAt = $purchasedAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     * @return Sponsorship
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get recallAt
     *
     * @return \DateTime
     */
    public function getRecallAt()
    {
        return $this->recallAt;
    }

    /**
     * Set recallAt
     *
     * @param \DateTime $recallAt
     * @return Sponsorship
     */
    public function setRecallAt($recallAt)
    {
        $this->recallAt = $recallAt;

        return $this;
    }

    /**
     * Get description
     *
     * @return SponsorshipDesc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param SponsorshipDesc $description
     * @return Sponsorship
     */
    public function setDescription(SponsorshipDesc $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Add gifts
     *
     * @param Gift $gifts
     * @return Sponsorship
     */
    public function addGift(Gift $gifts)
    {
        $this->gifts[] = $gifts;

        return $this;
    }

    /**
     * Remove gifts
     *
     * @param Gift $gifts
     */
    public function removeGift(Gift $gifts)
    {
        $this->gifts->removeElement($gifts);
    }

    /**
     * Get gifts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGifts()
    {
        return $this->gifts;
    }

    /**
     * Get godparent
     *
     * @return Godparent
     */
    public function getGodparent()
    {
        return $this->godparent;
    }

    /**
     * Set godparent
     *
     * @param Godparent $godparent
     * @return Sponsorship
     */
    public function setGodparent(Godparent $godparent = null)
    {
        $this->godparent = $godparent;

        return $this;
    }

    /**
     * Set animal
     *
     * @param Animal $animal
     * @return Sponsorship
     */
    public function setAnimal(Animal $animal)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get animal
     *
     * @return Animal
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set client
     *
     * @param Godparent $client
     * @return Sponsorship
     */
    public function setClient(Godparent $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return Godparent
     */
    public function getClient()
    {
        return $this->client;
    }
}
