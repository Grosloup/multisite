<?php

namespace ZPB\Admin\MediatekBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Image
 *
 * @ORM\Table(name="zpb_media_images")
 * @ORM\Entity(repositoryClass="ZPB\Admin\MediatekBundle\Entity\ImageRepository")
 */
class Image
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
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     * @Assert\Regex("/^[a-zA-Z0-9._-]*$/", message="Ce champ contient des caractères non autorisés.")
     * @ORM\Column(name="name", type="string", length=255, nullable=true, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=255)
     */
    private $extension;

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

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
     * @var string
     * @ORM\Column(name="thumb_dir", type="string", length=255, nullable=false)
     */
    private $thumbDir;

    /**
     * @param string $thumbDir
     */
    public function setThumbDir($thumbDir)
    {
        $this->thumbDir = $thumbDir;
    }

    /**
     * @return string
     */
    public function getThumbDir()
    {
        return $this->thumbDir;
    }

    /**
     * @var string
     * @ORM\Column(name="doc_root", type="string", length=255, nullable=false)
     */
    private $docRoot;

    //TODO remove avec unlink.

    public function __construct($uploadDir = "uploads/medias/img",$thumbDir = 'uploads/medias/thumbs', $docRoot = "web")
    {
        $this->uploadDir = $uploadDir;
        $this->thumbDir = $thumbDir;
        $this->docRoot = $docRoot;
    }

    public function getWebPath()
    {
        return $this->filename === null ? null : "/" . $this->uploadDir . "/" . $this->filename;
    }

    public function getWebThumbnail()
    {
        return $this->filename === null ? null : "/" . $this->thumbDir . "/" . $this->filename;
    }

    public function getAbsolutePath()
    {
        return $this->filename === null ? null : $this->docRoot . "/" . $this->uploadDir . "/" . $this->filename;
    }

    public function getAbsoluteThumbnail()
    {
        return $this->filename === null ? null : $this->docRoot . "/" . $this->thumbDir . "/" . $this->filename;
    }

    public function upload()
    {
        if($this->file == null){
            return false;
        }
        $this->extension = $this->file->guessExtension();
        $this->mime = $this->file->getMimeType();
        $dest = $this->docRoot . "/" . $this->uploadDir;
        $this->filename = $this->name === null ? $this->sanitizeFilename($this->file->getClientOriginalName()) : $this->name . "." . $this->extension;
        if($this->name === null){
            $this->name = preg_replace('/\.(jpe?g|png|gif)$/','',$this->filename);
        }
        $this->file->move($dest, $this->filename);
        $size = getimagesize($this->getAbsolutePath());
        $this->width = $size[0];
        $this->height = $size[1];
        $this->file = null;
        return true;
    }

    private function sanitizeFilename($string)
    {
        return preg_replace('/[^a-zA-Z0-9._-]/','',$string);
    }

    /**
     * @param string $docRoot
     */
    public function setDocRoot($docRoot)
    {
        $this->docRoot = $docRoot;
    }

    /**
     * @return string
     */
    public function getDocRoot()
    {
        return $this->docRoot;
    }

    /**
     * @param string $uploadDir
     */
    public function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    /**
     * @return string
     */
    public function getUploadDir()
    {
        return $this->uploadDir;
    }



    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * Set filename
     *
     * @param string $filename
     * @return Image
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
     * Set extension
     *
     * @param string $extension
     * @return Image
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
     * @return Image
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
     * @return Image
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Image
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
     * Set mime
     *
     * @param string $mime
     * @return Image
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
}
