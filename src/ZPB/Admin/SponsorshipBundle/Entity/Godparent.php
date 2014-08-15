<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;

/**
 * Godparent
 *
 * @ORM\Table(name="zpb_sponsorship_godparents")
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\GodparentRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("username", message="Ce pseudo est déjà utilisé.")
 */
class Godparent implements AdvancedUserInterface, Serializable
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
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champs contient des caractères non autorisés.")
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champs contient des caractères non autorisés.")
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(name="canonicalName", type="string", length=255, nullable=false, unique=true)
     * @Gedmo\Slug(fields={"firstname","lastname"})
     */
    private $canonicalName;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'., _-]+$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="username", type="string", length=255, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Email(message="Ce n'est pas une adresse email valide", checkMX=true, checkHost=true)
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Length(min="8", max="22", maxMessage="Le numéro de téléphone a trop de chiffres.", minMessage="Le numéro de téléphone n'a pas assez de chiffres.")
     * @Assert\Regex("/^[0-9. \/+-]+$/")
     * @ORM\Column(name="phone", type="string", length=22)
     */
    private $phone;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;)(:\/ _-]+$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;)(:\/ _-]*$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="address_two", type="string", nullable=true, length=255)
     */
    private $address2;

    /**
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;)(:\/ _-]*$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="batiment", type="string", nullable=true, length=255)
     */
    private $batiment;

    /**
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;)(:\/ _-]*$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="door", type="string", nullable=true, length=255)
     */
    private $door;

    /**
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;)(:\/ _-]*$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="floor", type="string", nullable=true, length=255)
     */
    private $floor;

    /**
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Regex("/^((2A|2a|2B|2b|0[1-9]|[1-8][0-9]|9[0-5])[0-9]{3})|((97[1-8]|984|98[6-9])[0-9]{2})$/", message="Le code postal n'est pas valide")
     * @ORM\Column(name="postalCode", type="string", nullable=false, length=255)
     */
    private $postalCode;

    /**
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;)(:\/ _-]+$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="city", type="string", nullable=false, length=255)
     */
    private $city;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;)(:\/ _-]+$/", message="Ce champs contient des caractères non autorisés.")
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    private $country;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthdate;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Choice(choices={"Mme","Mlle","Mr"}, message="Vous devez choisir entre Madame, Mademoiselle et Monsieur")
     * @ORM\Column(name="civilite", type="string", length=20)
     */
    private $civilite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @Assert\NotBlank(message="Ce champs est requis.")
     * @Assert\Length(min="8", minMessage="Le mot de passe doit contenir au moins 8 caractères alphanumériques")
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="tmp", type="string", length=255, nullable=true)
     */
    private $tmpPassword;

    /**
     * @var array
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @var bool
     * @ORM\Column(name="isActive", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="ZPB\Admin\SponsorshipBundle\Entity\Sponsorship", mappedBy="godparent")
     */
    private $sponsorships;

    public function __construct()
    {
        $this->roles = ['ROLE_GODFATHER'];
        $this->isActive = true;
        $this->country = 'France';
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->sponsorships = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    /**
     * @return mixed
     */
    public function getTmpPassword()
    {
        return $this->tmpPassword;
    }

    /**
     * @param mixed $tmpPassword
     */
    public function setTmpPassword($tmpPassword)
    {
        $this->tmpPassword = $tmpPassword;
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
     * @return boolean
     */
    public function isIsActive()
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
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }



    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
     * Set firstname
     *
     * @param string $firstname
     * @return Godparent
     */
    public function setFirstname($firstname)
    {
        $this->firstname = ucfirst(strtolower($firstname));

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Godparent
     */
    public function setLastname($lastname)
    {
        $this->lastname = ucfirst(strtolower($lastname));

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Godparent
     */
    public function setPassword($password)
    {
        $this->password = $password;

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
     * Set email
     *
     * @param string $email
     * @return Godparent
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Godparent
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Godparent
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Godparent
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return Godparent
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     * @return Godparent
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Godparent
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
        // TODO: Implement isAccountNonExpired() method.
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
        // TODO: Implement isAccountNonLocked() method.
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
        // TODO: Implement isCredentialsNonExpired() method.
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
        // TODO: Implement isEnabled() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function serialize()
    {
        return serialize(['id' => $this->getId()]);
    }

    public function unserialize($serialized)
    {
        $datas = unserialize($serialized);
        $this->id = $datas['id'];
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
     * Add sponsorships
     *
     * @param Sponsorship $sponsorships
     * @return Godparent
     */
    public function addSponsorship(Sponsorship $sponsorships)
    {
        $this->sponsorships[] = $sponsorships;

        return $this;
    }

    /**
     * Remove sponsorships
     *
     * @param Sponsorship $sponsorships
     */
    public function removeSponsorship(Sponsorship $sponsorships)
    {
        $this->sponsorships->removeElement($sponsorships);
    }

    /**
     * Get sponsorships
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSponsorships()
    {
        return $this->sponsorships;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Godparent
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set batiment
     *
     * @param string $batiment
     * @return Godparent
     */
    public function setBatiment($batiment)
    {
        $this->batiment = $batiment;

        return $this;
    }

    /**
     * Get batiment
     *
     * @return string
     */
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * Set door
     *
     * @param string $door
     * @return Godparent
     */
    public function setDoor($door)
    {
        $this->door = $door;

        return $this;
    }

    /**
     * Get door
     *
     * @return string
     */
    public function getDoor()
    {
        return $this->door;
    }

    /**
     * Set floor
     *
     * @param string $floor
     * @return Godparent
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return string
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return Godparent
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }


    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Godparent
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
}
