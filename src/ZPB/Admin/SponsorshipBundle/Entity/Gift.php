<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gift
 *
 * @ORM\Table(name="zpb_sponsorship_gifts")
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\GiftRepository")
 */
class Gift
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
     * @var boolean
     *
     * @ORM\Column(name="isDone", type="boolean", nullable=false)
     */
    private $isDone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="doneAt", type="datetime")
     */
    private $doneAt;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\GiftDesc")
     * @ORM\JoinColumn(name="gift_desc_id", referencedColumnName="id")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\Sponsorship", inversedBy="gifts")
     * @ORM\JoinColumn(name="sponsorship_id", referencedColumnName="id")
     */
    private $sponsorship;

    function __construct()
    {
        $this->isDone = false;
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
     * Set isDone
     *
     * @param boolean $isDone
     * @return Gift
     */
    public function setIsDone($isDone)
    {
        $this->isDone = $isDone;

        return $this;
    }

    /**
     * Get isDone
     *
     * @return boolean
     */
    public function getIsDone()
    {
        return $this->isDone;
    }

    /**
     * Set doneAt
     *
     * @param \DateTime $doneAt
     * @return Gift
     */
    public function setDoneAt($doneAt)
    {
        $this->doneAt = $doneAt;

        return $this;
    }

    /**
     * Get doneAt
     *
     * @return \DateTime
     */
    public function getDoneAt()
    {
        return $this->doneAt;
    }

    /**
     * Set description
     *
     * @param GiftDesc $description
     * @return Gift
     */
    public function setDescription(GiftDesc $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return GiftDesc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sponsorship
     *
     * @param Sponsorship $sponsorship
     * @return Gift
     */
    public function setSponsorship(Sponsorship $sponsorship = null)
    {
        $this->sponsorship = $sponsorship;

        return $this;
    }

    /**
     * Get sponsorship
     *
     * @return Sponsorship
     */
    public function getSponsorship()
    {
        return $this->sponsorship;
    }
}
