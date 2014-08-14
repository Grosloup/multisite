<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SponsorshipOrder
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\SponsorshipOrderRepository")
 */
class SponsorshipOrder
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
     * @var integer
     *
     * @ORM\Column(name="ref_id", type="integer")
     */
    private $refId;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     */
    private $clientId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_valid", type="boolean")
     */
    private $isValid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_refused", type="boolean")
     */
    private $isRefused;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_type", type="string", length=255)
     */
    private $paymentType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_delayed", type="boolean")
     */
    private $isDelayed;


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
     * Set refId
     *
     * @param integer $refId
     * @return SponsorshipOrder
     */
    public function setRefId($refId)
    {
        $this->refId = $refId;

        return $this;
    }

    /**
     * Get refId
     *
     * @return integer 
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return SponsorshipOrder
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SponsorshipOrder
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
     * Set isValid
     *
     * @param boolean $isValid
     * @return SponsorshipOrder
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean 
     */
    public function getIsValid()
    {
        return $this->isValid;
    }

    /**
     * Set isRefused
     *
     * @param boolean $isRefused
     * @return SponsorshipOrder
     */
    public function setIsRefused($isRefused)
    {
        $this->isRefused = $isRefused;

        return $this;
    }

    /**
     * Get isRefused
     *
     * @return boolean 
     */
    public function getIsRefused()
    {
        return $this->isRefused;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return SponsorshipOrder
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set paymentType
     *
     * @param string $paymentType
     * @return SponsorshipOrder
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return string 
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set isDelayed
     *
     * @param boolean $isDelayed
     * @return SponsorshipOrder
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
}
