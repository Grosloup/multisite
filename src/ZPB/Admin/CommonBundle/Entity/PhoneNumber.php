<?php

namespace ZPB\Admin\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * PhoneNumber
 *
 * @ORM\Table(name="zpb_admin_phones")
 * @ORM\Entity(repositoryClass="ZPB\Admin\CommonBundle\Entity\PhoneNumberRepository")
 */
class PhoneNumber
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
     * @Assert\Length(min="8", max="22", maxMessage="Le numéro de téléphone a trop de chiffres.", minMessage="Le numéro de téléphone n'a pas assez de chiffres.")
     * @Assert\Regex("/^[0-9. \/+-]+$/")
     * @ORM\Column(name="number", type="string", length=20)
     */
    private $number;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDefault", type="boolean")
     */
    private $isDefault;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\CommonBundle\Entity\User", inversedBy="phones")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    function __construct()
    {
        $this->isDefault = false;
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
     * Set number
     *
     * @param string $number
     * @return PhoneNumber
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return PhoneNumber
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return PhoneNumber
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return PhoneNumber
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
