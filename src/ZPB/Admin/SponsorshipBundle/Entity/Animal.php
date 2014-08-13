<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Animal
 *
 * @ORM\Table(name="zpb_sponsorship_animals")
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\AnimalRepository")
 * @UniqueEntity("name", message="Un animal porte déjà ce nom.")
 */
class Animal
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @ORM\Column(name="birthdate", type="datetime", nullable=false)
     */
    private $birthdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="shortDesc", type="text")
     */
    private $shortDesc;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="longDesc", type="text")
     */
    private $longDesc;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="longName", type="string", length=255, nullable=false, unique=true)
     */
    private $longName;

    /**
     * @ORM\Column(name="canonicalLongName", type="string", length=255, nullable=false, unique=true)
     * @Gedmo\Slug(fields={"longName"})
     */
    private $canonicalLongName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="birthPlace", type="string", length=255, nullable=false)
     */
    private $birthPlace;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"mâle","femelle"}, message="Vous devez choisir entre mâle et femelle")
     * @ORM\Column(name="sexe", type="string", length=15, nullable=false)
     */
    private $sexe;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="genus", type="string", length=255, nullable=false)
     */
    private $genus;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="genusLatin", type="string", length=255, nullable=false)
     */
    private $genusLatin;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="animalOrder", type="string", length=255, nullable=false)
     */
    private $animalOrder;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="family", type="string", length=255, nullable=false)
     */
    private $family;

    /**
     * @ORM\Column(name="class", type="string", length=255, nullable=false)
     */
    private $class;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="history", type="text", nullable=false)
     */
    private $history;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAvailable", type="boolean")
     */
    private $isAvailable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isArchived", type="boolean")
     */
    private $isArchived;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDropped", type="boolean")
     */
    private $isDropped;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="statusIUCN", type="string", length=255, nullable=false)
     */
    private $statusIUCN;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="geoDistribution", type="string", length=255, nullable=false)
     */
    private $geoDistribution;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="habitat", type="string", length=255, nullable=false)
     */
    private $habitat;

    public function __construct()
    {
        $this->isAvailable = false;
        $this->isArchived = false;
        $this->isDropped = false;
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
     * Set name
     *
     * @param string $name
     * @return Animal
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
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return Animal
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Animal
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
     * Set shortDesc
     *
     * @param string $shortDesc
     * @return Animal
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;

        return $this;
    }

    /**
     * Get shortDesc
     *
     * @return string
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }

    /**
     * Set longDesc
     *
     * @param string $longDesc
     * @return Animal
     */
    public function setLongDesc($longDesc)
    {
        $this->longDesc = $longDesc;

        return $this;
    }

    /**
     * Get longDesc
     *
     * @return string
     */
    public function getLongDesc()
    {
        return $this->longDesc;
    }

    /**
     * Set longName
     *
     * @param string $longName
     * @return Animal
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;

        return $this;
    }

    /**
     * Get longName
     *
     * @return string
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Set birthPlace
     *
     * @param string $birthPlace
     * @return Animal
     */
    public function setBirthPlace($birthPlace)
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    /**
     * Get birthPlace
     *
     * @return string
     */
    public function getBirthPlace()
    {
        return $this->birthPlace;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Animal
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set species
     *
     * @param string $genus
     * @return Animal
     */
    public function setGenus($genus)
    {
        $this->genus = $genus;

        return $this;
    }

    /**
     * Get genus
     *
     * @return string
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * Set genusLatin
     *
     * @param string $genusLatin
     * @return Animal
     */
    public function setGenusLatin($genusLatin)
    {
        $this->genusLatin = $genusLatin;

        return $this;
    }

    /**
     * Get genusLatin
     *
     * @return string
     */
    public function getGenusLatin()
    {
        return $this->genusLatin;
    }

    /**
     * Set history
     *
     * @param string $history
     * @return Animal
     */
    public function setHistory($history)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     * @return Animal
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set isArchived
     *
     * @param boolean $isArchived
     * @return Animal
     */
    public function setIsArchived($isArchived)
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * Get isArchived
     *
     * @return boolean
     */
    public function getIsArchived()
    {
        return $this->isArchived;
    }

    /**
     * Set isDropped
     *
     * @param boolean $isDropped
     * @return Animal
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
     * Set statusIUCN
     *
     * @param string $statusIUCN
     * @return Animal
     */
    public function setStatusIUCN($statusIUCN)
    {
        $this->statusIUCN = $statusIUCN;

        return $this;
    }

    /**
     * Get statusIUCN
     *
     * @return string
     */
    public function getStatusIUCN()
    {
        return $this->statusIUCN;
    }

    /**
     * @return mixed
     */
    public function getAnimalOrder()
    {
        return $this->animalOrder;
    }

    /**
     * @param mixed $animalOrder
     */
    public function setAnimalOrder($animalOrder)
    {
        $this->animalOrder = $animalOrder;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param mixed $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    /**
     * @return mixed
     */
    public function getGeoDistribution()
    {
        return $this->geoDistribution;
    }

    /**
     * @param mixed $geoDistribution
     */
    public function setGeoDistribution($geoDistribution)
    {
        $this->geoDistribution = $geoDistribution;
    }

    /**
     * @return mixed
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * @param mixed $habitat
     */
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;
    }

    /**
     * @return mixed
     */
    public function getCanonicalLongName()
    {
        return $this->canonicalLongName;
    }

    /**
     * @param mixed $canonicalLongName
     */
    public function setCanonicalLongName($canonicalLongName)
    {
        $this->canonicalLongName = $canonicalLongName;
    }


}
