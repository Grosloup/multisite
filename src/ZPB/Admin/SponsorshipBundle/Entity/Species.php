<?php

namespace ZPB\Admin\SponsorshipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Species
 *
 * @ORM\Table(name="zpb_sponsorship_species")
 * @ORM\Entity(repositoryClass="ZPB\Admin\SponsorshipBundle\Entity\SpeciesRepository")
 * @UniqueEntity("name", message="Une espèce porte déjà ce nom.")
 */
class Species
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
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     * @Assert\Regex("/^[a-zA-Z0-9_-]+$/", message="Ce champ contient des caractères non autorisés.")
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @var string
     * @Assert\NotBlank()
     *
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
     * @ORM\Column(name="genus", type="string", length=255, nullable=false)
     */
    private $genus;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="family", type="string", length=255, nullable=false)
     */
    private $family;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="class", type="string", length=255, nullable=false)
     */
    private $class;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç' -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="animalOrder", type="string", length=255, nullable=false)
     */
    private $animalOrder;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="statusIUCN", type="string", length=255, nullable=false)
     */
    private $statusIUCN;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="geoDistribution", type="string", length=255, nullable=false)
     */
    private $geoDistribution;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="habitat", type="string", length=255, nullable=false)
     */
    private $habitat;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="diet", type="text")
     */
    private $diet;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="size", type="string", length=255)
     */
    private $size;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="lifespan", type="string", length=255)
     */
    private $lifespan;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-zA-Zéèêëàûôç',;.)(: -]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="gestation", type="text")
     */
    private $gestation;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
     * Set diet
     *
     * @param string $diet
     * @return Species
     */
    public function setDiet($diet)
    {
        $this->diet = $diet;

        return $this;
    }

    /**
     * Get diet
     *
     * @return string
     */
    public function getDiet()
    {
        return $this->diet;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Species
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set weight
     *
     * @param string $weight
     * @return Species
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set lifespan
     *
     * @param string $lifespan
     * @return Species
     */
    public function setLifespan($lifespan)
    {
        $this->lifespan = $lifespan;

        return $this;
    }

    /**
     * Get lifespan
     *
     * @return string
     */
    public function getLifespan()
    {
        return $this->lifespan;
    }

    /**
     * Set gestation
     *
     * @param string $gestation
     * @return Species
     */
    public function setGestation($gestation)
    {
        $this->gestation = $gestation;

        return $this;
    }

    /**
     * Get gestation
     *
     * @return string
     */
    public function getGestation()
    {
        return $this->gestation;
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
     * Set genus
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


}
