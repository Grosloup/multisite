<?php

namespace ZPB\Admin\ZooBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * FImage
 *
 * @ORM\Table(name="fototek_zoo_images")
 * @ORM\Entity(repositoryClass="ZPB\Admin\ZooBundle\Entity\FImageRepository")
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 */
class FImage
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
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     * @Assert\Image(maxSize="6000000",mimeTypes ={"image/png","image/jpeg","image/gif"}, mimeTypesMessage="Votre image n'est pas une image valide.", maxSizeMessage="Votre image est trop lourde.")
     */
    public $file;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champ ne peut pas être vide.")
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'., _-]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'., _-]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    private $title;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,@ _-]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="copyright", type="string", length=255, nullable=false)
     */
    private $copyright;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9éèêëàûôç'.,;:!?&'+()@ _-]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="legend", type="text", nullable=true)
     */
    private $legend;

    /**
     * @var string
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=255)
     */
    private $mime;

    /**
     * @var string
     * @ORM\Column(name="upload_dir", type="string", length=255, nullable=false)
     */
    private $uploadDir;

    /**
     * @ORM\Column(name="subDirs", type="array")
     */
    private $thumbDirnames;

    /**
     * @var string
     * @ORM\Column(name="doc_root", type="string", length=255, nullable=false)
     */
    private $docRoot;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9]+$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="extension", type="string", length=10, nullable=false)
     */
    private $extension;

    /**
     * @var integer
     * @Assert\Regex("/^[0-9]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="width", type="integer", nullable=true)
     */
    private $width;

    /**
     * @var integer
     * @Assert\Regex("/^[0-9]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="height", type="integer", nullable=true)
     */
    private $height;

    /**
     * @var integer
     * @Assert\Regex("/^[0-9]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="countOriginal", type="integer", nullable=true)
     */
    private $countOriginal;

    /**
     * @var integer
     * @Assert\Regex("/^[0-9]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="countMr", type="integer", nullable=true)
     */
    private $countMr;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDisplayed", type="boolean", nullable=false)
     */
    private $isDisplayed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isArchived", type="boolean", nullable=false)
     */
    private $isArchived;

    /**
     * @var integer
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @Gedmo\SortableGroup
     * @ORM\ManyToOne(targetEntity="ZPB\Admin\ZooBundle\Entity\FCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;


    private $originalPathForRemove;  // docroot + uploaddir

    private $originalThumbDirnames; // subdirs img resizées

    private $originalFilename;


    public function __construct($uploadDir = "uploads/photos/zoo", $thumbDirnames = [], $docRoot = "web", $copyright="@ ZooParc de Beauval")
    {
        $this->uploadDir = $uploadDir;
        $this->thumbDirnames = $thumbDirnames;
        $this->docRoot = $docRoot;
        $this->copyright = $copyright;
        $this->isArchived = false;
        $this->isDisplayed = false;
        $this->countOriginal = 0;
        $this->countMr = 0;
    }

    /**
     * @ORM\PreRemove()
     */
    public function storePath()
    {
        $this->originalPathForRemove = $this->docRoot . "/" . $this->uploadDir;
        $this->originalThumbDirnames = $this->thumbDirnames;
        $this->originalFilename = $this->filename;
    }

    /**
     * @ORM\PostRemove()
     */
    public function remove()
    {
        if($this->originalPathForRemove != null){
            unlink($this->originalPathForRemove . '/' . $this->originalFilename);
        }
        if($this->originalPathForRemove != null && $this->originalThumbDirnames != null){
            foreach($this->originalThumbDirnames as $k=>$dir){
                $path = $this->getAbsolutePathByType($k);
                if($path){
                    unlink($path);
                }
            }
        }
    }

    public function upload()
    {
        if ($this->file == null) {
            return false;
        }
        $this->extension = $this->file->guessExtension();
        $this->mime = $this->file->getMimeType();
        $dest = $this->docRoot . "/" . $this->uploadDir;
        $this->filename = $this->name === null ? $this->sanitizeFilename($this->file->getClientOriginalName()) : $this->name . "." . $this->extension;
        if ($this->name === null) {
            $this->name = preg_replace('/\.(jpe?g|png|gif|JPE?G|PNG|GIF)$/', '', $this->filename);
        }
        $this->file->move($dest, $this->filename);
        $size = getimagesize($this->getAbsolutePathOriginal());
        $this->width = $size[0];
        $this->height = $size[1];
        $this->file = null;
        return true;
    }

    private function sanitizeFilename($string="")
    {
        return preg_replace('/[^a-zA-Z0-9._-]/', '', $string);
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
     * @return FImage
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
     * @return FImage
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
     * Set title
     *
     * @param string $title
     * @return FImage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return FImage
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return FImage
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
     * Set legend
     *
     * @param string $legend
     * @return FImage
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string 
     */
    public function getLegend()
    {
        return $this->legend;
    }

    public function getAbsolutePathByType($type = "")
    {
        if(!$type || !array_key_exists($type, $this->thumbDirnames) || $this->thumbDirnames[$type]==null){
            return null;
        }
        return $this->filename === null ? null :$this->docRoot . '/' . $this->uploadDir . '/' . $this->thumbDirnames[$type] . '/' . $this->thumbDirnames[$type] . '_' . $this->filename;
    }

    /**
     * Get absolutePath
     *
     * @return string 
     */
    public function getAbsolutePathOriginal()
    {
        return $this->filename === null ? null :$this->docRoot . '/' . $this->uploadDir . '/' . $this->filename;
    }

    /**
     * Get webPath
     *
     * @return string 
     */
    public function getWebPathOriginal()
    {
        return $this->filename === null ? null : '/' . $this->uploadDir . '/' . $this->filename;
    }

    /**
     * Set extension
     *
     * @param string $extension
     * @return FImage
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string 
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return FImage
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return FImage
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set countOriginal
     *
     * @param integer $countOriginal
     * @return FImage
     */
    public function setCountOriginal($countOriginal)
    {
        $this->countOriginal = $countOriginal;

        return $this;
    }

    /**
     * Get countOriginal
     *
     * @return integer 
     */
    public function getCountOriginal()
    {
        return $this->countOriginal;
    }

    /**
     * Set countMr
     *
     * @param integer $countMr
     * @return FImage
     */
    public function setCountMr($countMr)
    {
        $this->countMr = $countMr;

        return $this;
    }

    /**
     * Get countMr
     *
     * @return integer 
     */
    public function getCountMr()
    {
        return $this->countMr;
    }

    /**
     * Set isDisplayed
     *
     * @param boolean $isDisplayed
     * @return FImage
     */
    public function setIsDisplayed($isDisplayed)
    {
        $this->isDisplayed = $isDisplayed;

        return $this;
    }

    /**
     * Get isDisplayed
     *
     * @return boolean 
     */
    public function getIsDisplayed()
    {
        return $this->isDisplayed;
    }

    /**
     * Set isArchived
     *
     * @param boolean $isArchived
     * @return FImage
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
     * Set position
     *
     * @param integer $position
     * @return FImage
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return FImage
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set mime
     *
     * @param string $mime
     * @return FImage
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string 
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set uploadDir
     *
     * @param string $uploadDir
     * @return FImage
     */
    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;

        return $this;
    }

    /**
     * Get uploadDir
     *
     * @return string 
     */
    public function getUploadDir()
    {
        return $this->uploadDir;
    }

    /**
     * Set thumbDirnames
     *
     * @param array $thumbDirnames
     * @return FImage
     */
    public function setThumbDirnames($thumbDirnames)
    {
        $this->thumbDirnames = $thumbDirnames;

        return $this;
    }

    /**
     * Get thumbDirnames
     *
     * @return array 
     */
    public function getThumbDirnames()
    {
        return $this->thumbDirnames;
    }

    /**
     * Set docRoot
     *
     * @param string $docRoot
     * @return FImage
     */
    public function setDocRoot($docRoot)
    {
        $this->docRoot = $docRoot;

        return $this;
    }

    /**
     * Get docRoot
     *
     * @return string 
     */
    public function getDocRoot()
    {
        return $this->docRoot;
    }

    /**
     * Set category
     *
     * @param FCategory $category
     * @return FImage
     */
    public function setCategory(FCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return FCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
