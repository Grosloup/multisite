<?php

namespace ZPB\Admin\CommonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="zpb_admin_users")
 * @ORM\Entity(repositoryClass="ZPB\Admin\CommonBundle\Entity\UserRepository")
 * @UniqueEntity("username")
 */
class User implements AdvancedUserInterface, Serializable
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
     * @ORM\Column(name="firstname", type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     */
    private $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(name="canonical_name", type="string", nullable=false, length=255, unique=true)
     * @Gedmo\Slug(fields={"firstname","lastname"}, unique=true)
     *
     */
    private $canonicalName;
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="username", type="string", length=255, nullable=false, unique=true)
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'., _-]+$/", message="Ce champ contient des caractères non autorisés.")
     */
    private $username;
    /**
     * @var string
     * @Assert\Length(min="8", minMessage="Le mot de passe doit contenir au moins 8 caractères alphanumérique")
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;
    /**
     * @var array
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;
    /**
     * @var boolean
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    /**
     * @ORM\OneToMany(targetEntity="ZPB\Admin\CommonBundle\Entity\Email", mappedBy="user")
     */
    private $emails;
    /**
     * @var string
     * @ORM\Column(name="primary_email", type="string", length=255, nullable=true)
     */
    private $primaryEmail;
    /**
     * @ORM\OneToMany(targetEntity="ZPB\Admin\CommonBundle\Entity\PhoneNumber", mappedBy="user")
     */
    private $phones;

    /**
     * @ORM\Column(name="primary_phone", type="string", length=20, nullable=true)
     */
    private $primaryPhone;

    function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->roles = ['ROLE_USER'];
        $this->isActive = false;
        $this->emails = new ArrayCollection();
        $this->phones = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getPrimaryPhone()
    {
        return $this->primaryPhone;
    }

    /**
     * @param mixed $primaryPhone
     */
    public function setPrimaryPhone($primaryPhone)
    {
        $this->primaryPhone = $primaryPhone;
    }

    /**
     * @return string
     */
    public function getCanonicalName()
    {
        return $this->canonicalName;
    }

    /**
     * @param string $canonicalName
     */
    public function setCanonicalName($canonicalName)
    {
        $this->canonicalName = $canonicalName;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles = [])
    {
        $this->roles = array_unique(array_merge($this->getRoles(), $roles));
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsActive()
    {
        return $this->isActive;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }


    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        //return true;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool    true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool    true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return $this->isActive;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool    true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool    true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return true;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(['id' => $this->getId()]);
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
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        $datas = unserialize($serialized);
        $this->id = $datas['id'];
    }

    /**
     * Add emails
     *
     * @param Email $emails
     * @return User
     */
    public function addEmail(Email $emails)
    {
        $this->emails[] = $emails;
        if ($emails->getIsDefault()) {
            $this->primaryEmail = $emails->getName();
        }
        return $this;
    }

    /**
     * Remove emails
     *
     * @param Email $emails
     */
    public function removeEmail(Email $emails)
    {
        $this->emails->removeElement($emails);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @return string
     */
    public function getPrimaryEmail()
    {
        return $this->primaryEmail;
    }

    /**
     * @param string $primaryEmail
     */
    public function setPrimaryEmail($primaryEmail)
    {
        $this->primaryEmail = $primaryEmail;
    }

    public function getMaxRole()
    {
        if (in_array('ROLE_SUPERADMIN', $this->roles)) {
            return 'Super Administrateur';
        }
        if (in_array('ROLE_ADMIN', $this->roles)) {
            return 'Administrateur';
        }
        return 'Utilisateur';
    }

    public function isSuperAdmin()
    {
        return in_array('ROLE_SUPERADMIN', $this->roles);
    }

    public function isAdmin()
    {
        return in_array('ROLE_ADMIN', $this->roles);
    }

    /**
     * Add phones
     *
     * @param PhoneNumber $phones
     * @return User
     */
    public function addPhone(PhoneNumber $phones)
    {
        $this->phones[] = $phones;

        return $this;
    }

    /**
     * Remove phones
     *
     * @param PhoneNumber $phones
     */
    public function removePhone(PhoneNumber $phones)
    {
        $this->phones->removeElement($phones);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }
}
